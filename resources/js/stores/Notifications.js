import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { defineStore } from "pinia";
import { useAttrs } from "vue";

export const notificationStore = defineStore("notifications", {
    state: () => ({
        notifications: [],
        unreadNotifications: 0,
    }),
    actions: {
        getNotifications() {
            axios
                .get(route("notifications.get"))
                .then((response) => {
                    this.notifications = response.data.notifications;
                    this.unreadNotifications = response.data.unread_count;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        connect() {
            const attrs = useAttrs();
            let vm = this;
            this.getNotifications();
            window.Echo.channel(attrs.user_id + "-notifications").listen(
                ".notification",
                (e) => {
                    // vm.getNotifications();
                  this.notifications.push(JSON.stringify(e));

                }
            );
        },
        disconenct() {
            const attrs = useAttrs();
            window.Echo.leave(attrs.user_id + "-notifications");
        },

        deleteNotification(notification_id) {
            Inertia.delete("notifications/" + notification_id + "/delete", {
                preserveScroll: true,
            });
            this.getNotifications();
        },
        readNotifications(notification_id) {
            this.unreadNotifications = 0;
            Inertia.patch(route("notifications.read"));
        },
    },
});
