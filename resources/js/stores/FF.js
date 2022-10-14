import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { defineStore } from "pinia";

export const useFFStore = defineStore("followings-followers", {
    state: () => ({ followings: [] ,followers: [],checkedAccounts:[]}),
    getters: {
        //   doubleCount: (state) => state.count * 2,
    },
    actions: {
        async fill() {
            try {
                const followings = await axios.get(
                    route("getFollowings")
                );
                this.followings = followings.data;

                const followers = await axios.get(
                    route("getFollowers")
                );
                this.followers = followers.data;
            } catch (error) {
                alert(error);
                console.log(error);
            }
        },
         follow (username) {
            Inertia.get("/follow/" + username)
        }
    },
});
