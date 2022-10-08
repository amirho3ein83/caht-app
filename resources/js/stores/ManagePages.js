import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";

export const managePageStore = defineStore("manage-pages", {
    state: () => ({ currentSidebar: "" }),

    actions: {
        async setPage(page) {
            Inertia.get(
                route(page),
            );
            this.currentSidebar = page
        },
    },
});
