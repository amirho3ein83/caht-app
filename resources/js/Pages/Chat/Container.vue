<script>


import AppLayout from "@/Layouts/AppLayout.vue";
import ChatItem from "./ChatItem.vue";
import MessageItem from "./MessageItem.vue";
import { Link } from "@inertiajs/inertia-vue3";

import FollowingDetails from "./FollowingDetails.vue";
import MessageContainer from "./MessageContainer.vue";
import Navbar from "./Navbar.vue";
import ContactBio from "./ContactBio.vue";
import Sidebar from "./Sidebar.vue";


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
    Sidebar
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
            <!-- component -->
            <!-- This is an example component -->
            <Sidebar/>


            <div
                class=" sm:visible flex-1 p:2  justify-between flex flex-col h-screen my-0 bg-gradient-to-b from-gray-400 via-gray-500 to-gray-600">
                <FollowingDetails v-if="currentChat.id" :following="following" :currentChat="currentChat" />
                <!-- <h2 class="mx-auto animate-pulse" v-else>Let's start by choosing one chat</h2> -->
                <MessageContainer :currentChat="currentChat" :messages="messages" />
            </div>
        </div>
    </AppLayout>
</template>
