import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { defineStore } from "pinia";

export const useFollowersStore = defineStore("followers", {
    state: () => ({ followers: [] }),
    getters: {
        //   doubleCount: (state) => state.count * 2,
    },
    actions: {
        async fill() {
            try {
                const data = await axios.get(
                    route("getFollowers")
                );
                this.followers = data.data;
            } catch (error) {
                alert(error);
                console.log(error);
            }
        },
    },
});
