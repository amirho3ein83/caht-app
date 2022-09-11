<script>


import AppLayout from "@/Layouts/AppLayout.vue";
import ChatItem from "./ChatItem.vue";
import MessageItem from "./MessageItem.vue";
import { Link } from "@inertiajs/inertia-vue3";

import FollowingDetails from "./FollowingDetails.vue";
import MessageContainer from "./MessageContainer.vue";
import Navbar from "./Navbar.vue";
import ContactBio from "./ContactBio.vue";


export default {
    props: ["user"],
    components: {
        AppLayout,
        MessageContainer,
        ChatItem,
        MessageItem,
        Link,
        FollowingDetails,
        Navbar,
        ContactBio,
    },
    data: function () {
        return {
            chats: [],
            currentChat: [],
            messages: [],
            current_contact: this.$page.props.user.id,
            following: [],
            showbioPage: false,
        };
    },

    watch: {
        currentChat(val, oldval) {
            if (oldval.id) {
                this.disconenct(oldval);
            }
            this.connect();
        },
    },
    methods: {
        logout() {
            axios.post(route("logout"));
        },
        toggleBioPage() {
            this.showbioPage = !this.showbioPage
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
        getChats() {
            axios
                .get( "chats")
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
        setChat(chat) {
            // get second contact details
            axios
                .get("following/"+chat.following +"/get-details")
                .then((response) => {
                    this.following = response.data[0];
                })
                .catch((error) => {
                    console.log(error);
                });

            this.currentChat = chat;

        },
    },
    created() {

        this.getChats();
console.log('online');
        // online user
        // axios
        //     .post("/member/" + this.$page.props.contact.id + "/online")
        //     .then((response) => {
        //         console.log('ur online');
        //     })
        //     .catch((error) => {
        //         console.log(error);
        //     });
    },

};
</script> 

<template>
    <AppLayout>
        <div class="flex mx-auto justify-center">
            <ContactBio v-if="showbioPage" v-on:closeBioPage="toggleBioPage" />
            <div v-if="!showbioPage"
                class=" block bg-gradient-to-r from-gray-800 overflow-x-auto to-gray-600 p-2 my-0 flex-col align-center h-screen"
                style="width: 420px;">

                <div class="m-4">
                    <Navbar  v-on:closeBioPage="toggleBioPage" />


                    <div class="w-96 mx-auto relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            class="block rounded-2xl p-1 mb-4 w-96 text-lg text-gray-900 h-10 bg-gray-300 outline-none focus:bg-gray-200"
                            placeholder="           Search Contacts" />
                    </div>



                    <div
                        class=" flex flex-1 flex-end flex-col space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                        <div id="messages"
                            class="flex flex-end h-100 flex-col-reverse space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                            <div>
                                <template v-for="chat in chats" :key="chat.id">
                                    <ChatItem v-if="chat" :chat="chat"
                                        :currentChat="currentChat"
                                        v-on:chatChanged="setChat($event)" v-on:following="
                                            setSecondContact($event)
                                        " />
                                </template>
                                <p class="text-slate-300 font-medium text-center animate-pulse" v-if="noChat()">
                                    let's start following others to chat with!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div
                class=" sm:visible flex-1 p:2  justify-between flex flex-col h-screen my-0 bg-gradient-to-b from-gray-400 via-gray-500 to-gray-600">
                <FollowingDetails v-if="currentChat.id" :following="following"
                    :currentChat="currentChat" />
                <h2 class="mx-auto animate-pulse" v-else>Let's start by choosing one chat</h2>
                <MessageContainer :currentChat="currentChat" :messages="messages" />
            </div>
        </div>
    </AppLayout>
</template>
