import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { defineStore } from "pinia";

export const Connection = defineStore("connection", {
    state: () => ({
            chats: [],
            currentChat: [],
            messages: [],
            followings: [],
            followers: [],
            numberOfFollowers: 0,
            numberOfFollowings: 0,
    }),
    actions:{

        logout() {
            axios.post(route("logout"));
        },




    }
});
