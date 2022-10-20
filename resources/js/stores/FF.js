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
                    route("followers.get",1)
                );
                this.followings = followings.data;

                const followers = await axios.get(
                    route("followers.get",1)
                );
                this.followers = followers.data;
            } catch (error) {
                alert(error);
                console.log(error);
            }
        },
         follow (id) {
            Inertia.get(route('follow',{id:id}))
        },
         unFollow (id) {
            Inertia.delete(route('unFollow',{id:id}))
        },
         countFollowers () {
            Inertia.get("/follow/" + username)
        },
        countFollowings () {
            Inertia.get("/follow/" + username)
        },
    },
});
