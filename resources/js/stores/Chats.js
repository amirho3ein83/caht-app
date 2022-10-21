import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { defineStore } from "pinia";
import { notificationStore } from "@/stores/Notifications";
import { toRaw } from "vue";
// import sound from "./sounds/1.mp3";

export const useChatsStore = defineStore("chats", {
    state: () => ({
        chats: [],
        currentChat: [],
        messages: [],
        addressee: [],
        followings: [],
        followers: [],
        numberOfFollowers: 0,
        numberOfFollowings: 0,
    }),
    getters: {
        //   doubleCount: (state) => state.count * 2,
    },
    actions: {
        getChats() {
            axios
                .get("chats")
                .then((response) => {
                    this.chats = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
            const useNotificationStore = notificationStore();

            useNotificationStore.connect();
            useNotificationStore.getNotifications();
        },

        noChat() {
            return this.chats.length != 0 ? false : true;
        },
        getMessages() {
            if (this.currentChat.id) {
                axios
                    .get("/chats/" + this.currentChat.id + "/messages")
                    .then((response) => {
                        this.messages = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        getFollowingInfo() {
            axios
                .get("following/" + this.currentChat.name + "/get-details")
                .then((response) => {
                    this.addressee = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        setChat(chat) {
            
            this.currentChat = chat;
            this.connect();
            this.getMessages();
            this.currentChat.unread_messages_count = 0;
            Inertia.patch("/chats/" + chat.id + "/seen-messages");
        },
        startChat(id) {

            Inertia.patch(route('startChat',{id:id}));
        },

        connect() {
            if (this.currentChat.id) {
                let vm = this;
                // this.getMessages();

                // var pusher = new Pusher('f34545b3437b823f4b8c', {
                //     cluster: 'mt1'
                //   });

                // var channel = pusher.subscribe("chat." + this.currentChat.id);
                // channel.bind('.message', function(data) {
                //   this.messages.push(JSON.stringify(data));
                // });
                window.Echo.private("chat." + this.currentChat.id).listen(
                    ".message",
                    (e) => {
                        console.log(e);
                //   this.messages.push(JSON.stringify(e));

                        // vm.getMessages();
                        // const audio = new Audio(sound);
                        //   audio.play()
                    }
                );
            }
        },
        disconenct(chat) {
            window.Echo.leave("chat." + chat.id);
        },
        blockContact() {
            Inertia.patch("block/" + this.addressee.id);
            this.currentChat.is_blocked = true;
        },
        muteChat() {
            Inertia.patch("chats/" + this.currentChat.id + "/mute");
            this.currentChat.is_muted = true;
        },
        unmuteChat() {
            Inertia.patch("chats/" + this.currentChat.id + "/unmute");
            this.currentChat.is_muted = false;
        },
        unBlockContact(user) {
            this.currentChat.is_blocked = false;
            Inertia.patch("unblock/" + user);
            this.getChats();
        },

        deleteChat() {
            Inertia.delete(
                "chats/" + this.currentChat.id + "/" + this.addressee.id,
                {
                    preserveScroll: true,
                    onSuccess: () => this.getChats(),
                }
            );
        },
    },
});
