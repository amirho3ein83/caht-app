import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { defineStore } from "pinia";

export const useFollowingsStore = defineStore("followings", {
    state: () => ({ followings: [] }),
    getters: {
        //   doubleCount: (state) => state.count * 2,
    },
    actions: {
        async fill() {
            try {
                const data = await axios.get(
                    route("getFollowings")
                );
                this.followings = data.data;
            } catch (error) {
                alert(error);
                console.log(error);
            }
        },
    },
});
