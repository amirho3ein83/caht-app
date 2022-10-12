import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";

export const managePageStore = defineStore("manage-pages", {
    state: () => ({ currentSidebar: "" ,users:[]}),

    actions: {
        setPage(page) {
            this.currentSidebar = page;
if(page == 'ExploreUsers'){
    console.log('hhhh');
    Inertia.post(
        route(page),
        {},
        {
            preserveState: true,
            onSuccess: () => {},
        }
    );
}
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
