import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { defineStore } from "pinia";

export const useChatsStore = defineStore("chats", {
    state: () => ({
        chats: [],
        currentChat: [],
        messages: [],
        addressee: [],
        followings: [],
        followers: [],
        numberOfFollowers: 0,
        numberOfFollowings: 0,        }),
    getters: {
        //   doubleCount: (state) => state.count * 2,
    },
    actions: {
        async getChats() {
            try {
                const data = await axios.get(
                    "chats"
                );
                this.chats = data.data;
                console.log(this.chats)
            } catch (error) {
                alert(error);
                console.log(error);
            }
        },
        getChats() {
            axios
                .get("chats")
                .then((response) => {
                    this.chats = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        noChat() {
            return this.chats.length != 0 ? false : true;
        },
        getMessages() {
            axios
                .get(
                    "/chats/" +
                    this.currentChat.id +
                    "/messages"
                )
                .then((response) => {
                    this.messages = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getFollowingInfo() {
            axios
                .get(
                   'following/'+this.currentChat.name+'/get-details'
                )
                .then((response) => {
                    this.addressee = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        setChat(chat) {
            // get second contact details
            axios
                .get("following/" + chat.following + "/get-details")
                .then((response) => {
                    this.following = response.data[0];
                })
                .catch((error) => {
                    console.log(error);
                });

            this.currentChat = chat;
            this.getMessages()
            this.getFollowingInfo()

        },
    },
});
