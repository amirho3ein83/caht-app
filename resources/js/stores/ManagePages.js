import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";
import { notificationStore } from "@/stores/Notifications";

export const managePageStore = defineStore("manage-pages", {
    state: () => ({ currentSidebar: "", users: [] }),

    actions: {
        setPage(page) {
            const useNotificationStore = notificationStore();
            this.currentSidebar = page;
            switch (page) {
                case "Notifications":
                    Inertia.get(
                        route(page),
                        {},
                        {
                            preserveState: true,
                            onSuccess: () => {
                                useNotificationStore.readNotifications();
                            },
                        }
                    );

                    break;
                default:
                    Inertia.get(
                        route(page),
                        {},
                        {
                            preserveState: true,
                            onSuccess: () => {},
                        }
                    );
                    break;
            }
        },
    },
});
