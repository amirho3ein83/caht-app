<script>


import AppLayout from "@/Layouts/AppLayout.vue";
import ConversationItem from "./ConversationItem.vue";
import MessageItem from "./MessageItem.vue";
import { Link } from "@inertiajs/inertia-vue3";

import ContactDetails from "./ContactDetails.vue";
import MessageContainer from "./MessageContainer.vue";
import UserInfo from "./UserInfo.vue";
import NavLink from "../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Components/NavLink.vue";
import JetNavLink from '@/Components/NavLink.vue';

export default {
    props: ["user"],
    components: {
        AppLayout,
        MessageContainer,
        ConversationItem,
        MessageItem,
        Link,
        ContactDetails,
        UserInfo,
        NavLink
    },
    data: function () {
        return {
            conversations: [],
            currentConversation: [],
            messages: [],
            current_contact: this.$page.props.contact.id,
            second_contact: [],
        };
    },

    watch: {
        currentConversation(val, oldval) {
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
        connect() {
            if (this.currentConversation.id) {
                let vm = this;
                this.getMessages();
                window.Echo.private(
                    "chat." + this.currentConversation.id
                ).listen(".message", (e) => {
                    vm.getMessages();
                });
            }
        },
        disconenct(conversation) {
            window.Echo.leave("chat." + conversation.id);
        },
        getConversations() {
            axios
                .post(
                    route("conversations", {
                        contactId: this.$page.props.user.id,
                    })
                )
                .then((response) => {
                    this.conversations = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        noConversation() {
            return this.conversations.length != 0 ? false : true;
        },
        getMessages() {
            axios
                .get(
                    "/chat/conversations/" +
                    this.currentConversation.id +
                    "/messages"
                )
                .then((response) => {
                    this.messages = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        setConversation(conversation) {
            // get second contact details
            axios
                .post("get/contact/", { username: conversation.second_contact })
                .then((response) => {
                    this.second_contact = response.data[0];
                })
                .catch((error) => {
                    console.log(error);
                });

            this.currentConversation = conversation;

        },
    },
    created() {

        this.getConversations();

        // online user
        axios
            .post("/member/" + this.$page.props.contact.id + "/online")
            .then((response) => {
                console.log('ur online');
            })
            .catch((error) => {
                console.log(error);
            });
    },

};
</script> 

<template>
    <AppLayout>
        <div class="flex mx-auto justify-center">

            <div class="bg-gradient-to-b from-gray-700 to-gray-600 pb-5 pt-2 w-60 my-0 flex-col align-center"
                style="width: 420px;">

                <UserInfo />


                <div class="w-96 mx-auto relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input
                        class="block rounded-2xl p-2 mb-4 w-full text-lg text-gray-900 h-12 bg-gray-300 outline-none focus:bg-gray-200"
                        placeholder="           Search Contacts" />
                </div>



                <div
                    class=" flex flex-1 flex-end flex-col space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                    <div id="messages"
                        class="flex flex-end h-100 flex-col-reverse space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                        <div>
                            <template v-for="conversation in conversations" :key="conversation.id">
                                <ConversationItem v-if="conversation" :conversation="conversation"
                                    :currentConversation="currentConversation"
                                    v-on:roomChanged="setConversation($event)" v-on:second_contact="
                                        setSecondContact($event)
                                    " />
                            </template>
                            <p class="text-slate-300 font-medium text-center animate-pulse" v-if="noConversation()">
                                add a contact to chat with
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <div
                class=" sm:visible flex-1 p:2  justify-between flex flex-col h-screen my-0 bg-gradient-to-b from-gray-400 via-gray-500 to-gray-600">
                <ContactDetails :second_contact="second_contact" v-if="currentConversation.id" />
                <h2 class="mx-auto animate-pulse" v-else>Let's start by choosing one conversation</h2>
                <MessageContainer :currentConversation="currentConversation" :messages="messages" />
            </div>
        </div>
    </AppLayout>
</template>
