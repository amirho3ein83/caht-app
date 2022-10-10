import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";

export const managePageStore = defineStore("manage-pages", {
    state: () => ({ currentSidebar: "" ,users:[]}),

    actions: {
        setPage(page) {
            this.currentSidebar = page;

            Inertia.get(
                route(page),
                {},
                {
                    preserveState: true,
                    onSuccess: () => {},
                }
            );
        },
    },
});
