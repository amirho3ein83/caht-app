import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { defineStore } from "pinia";

export const useGetChatsStore = defineStore("chatss", {
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
        // getChats() {
        //     axios
        //         .get("chats")
        //         .then((response) => {
        //             this.chats = response.data;
        //             console.log(this.chats)
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        // },
        logout() {
            axios.post(route("logout"));
        },

        connect() {
            if (this.currentChat.id) {
                let vm = this;
                this.getMessages();
                window.Echo.private(
                    "chat." + this.currentChat.id
                ).listen(".message", (e) => {
                    vm.getMessages();
                });
            }
        },
        disconenct(chat) {
            window.Echo.leave("chat." + chat.id);
        },

        getFollowings ()  {
             axios
                .get("followings")
                .then((response) => {
                    this.numberOfFollowings = response.data.length;
        
                    this.followings = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getFollowers() {
            // async fetchAuthors() {
            //     this.authors = await fetch('https://jsonplaceholder.typicode.com/users')
            //     .then((response) => response.json())
            //   }
            this.followers = fetch
                .get("followers")
                .then((response) => {response.json()
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
});
