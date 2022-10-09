import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { defineStore } from "pinia";

export const notificationStore = defineStore("notifications", {
    state: () => ({
        notifications: [],
    }),
    actions: {
        getNotifications() {
            axios
                .get(route("notifications.get"))
                .then((response) => {
                    console.log(response.data);
                    this.notifications = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        noNotification() {
            return this.notifications.length != 0 ? false : true;
        },
        connect(user_id) {
            if (this.currentnotification.id) {
                let vm = this;
                this.getMessages();
                window.Echo.private(user_id).listen(
                    ".notifications",
                    (e) => {
                        vm.getNotifications();
                    }
                );
            }
        },
        disconenct(user_id) {
            window.Echo.leave(user_id+".notifications");
        },

        deleteNotification(notification_id) {
            Inertia.delete(
                "notifications/" + notification_id +'/delete',
                {
                    preserveScroll: true,
                }
            );
        },
    },
});
