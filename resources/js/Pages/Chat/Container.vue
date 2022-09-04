<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ConversationItem from "./ConversationItem.vue";
import InputMessage from "./InputMessage.vue";
import MessageItem from "./MessageItem.vue";
import { Link } from "@inertiajs/inertia-vue3";

import ContactDetails from "./ContactDetails.vue";
import MessageContainer from "./MessageContainer.vue";
import UserInfo from "./UserInfo.vue";
import ContactSearchbox from "./ContactSearchbox.vue";

export default {
    props: ["user"],
    components: {
        AppLayout,
        MessageContainer,
        ConversationItem,
        InputMessage,
        MessageItem,
        Link,
        ContactDetails,
        UserInfo,
        ContactSearchbox,
    },
    data: function () {
        return {
            conversations: [],
            currentConversation: [],
            messages: [],
            current_contact: [],
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
        // userProfile() {
        //     axios.get("user/profile");
        // },
        noConversation() {
            return this.conversations.length != 0 ? false : true
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
                .post("get/contact/",{username:conversation.second_contact})
                .then((response) => {
                    this.second_contact = response.data[0]
                })
                .catch((error) => {
                    console.log(error);
                });

                this.currentConversation = conversation;
            // this.second_contact = conversation.second_contact

            // offline user hiself
            // axios
            //     .post("/member/" + this.current_contact.id + "/offline")
            //     .then((response) => {})
            //     .catch((error) => {
            //         console.log(error);
            //     });

            // this.currentConversation = conversation;
            // this.current_contact = this.currentConversation.contacts[0]
            //     ? this.$page.props.user
            //     : this.currentConversation.contacts[1];

            // if (
            //     this.current_contact ==
            //     this.currentConversation.contacts[0]
            // ) {
            //     this.second_contact =
            //         this.currentConversation.contacts[1] ??
            //         this.currentConversation.name;
            //     this.current_contact =
            //         this.currentConversation.contacts[0] ??
            //         this.currentConversation.name;
            // } else {
            //     this.second_contact =
            //         this.currentConversation.contacts[0] ??
            //         this.currentConversation.name;
            //     this.current_contact =
            //         this.currentConversation.contacts[1] ??
            //         this.currentConversation.name;
            // }
        },
    },
    created() {
        this.getConversations();
    },

};
</script>

<template>
    <AppLayout title="Chat">
        <div class="flex mx-auto justify-center">
            <div
                class="p:2 sm:py-4 justify-between flex flex-col h-screen max-w-2xl my-0 bg-gradient-to-b from-gray-400 via-gray-500 to-gray-600"
            >
                <ContactDetails
                    :second_contact="second_contact"
                    v-if="second_contact.length != 0"
                />
                
                <div v-else class="mx-auto mb-5">
                    <h3 class="text-slate-900">
                        Please choose one conversation
                    </h3>
                </div>

                <MessageContainer
                    :currentConversation="currentConversation"
                    :messages="messages"
                />
            </div>
            <div></div>
            <div
                class="bg-gradient-to-b from-gray-700 to-gray-600 py-5 w-60 my-0 flex-col align-center"
            >
                <UserInfo />
                <ContactSearchbox />

                <div
                    style="height: 500px"
                    class="flex flex-1 flex-end flex-col space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch"
                >
                    <div
                        id="messages"
                        class="flex flex-end flex-col-reverse space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch"
                    >
                        <div>
                            <template
                                v-for="conversation in conversations"
                                :key="conversation.id"
                            >
                                <ConversationItem
                                    :conversation="conversation"
                                    v-on:roomChanged="setConversation($event)"
                                    v-on:second_contact="setSecondContact($event)"
                                />
                            </template>
                            <p
                                class="text-slate-300 font-medium text-center animate-pulse"
                                v-if="noConversation()"
                            >
                                add a contact to chat with
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
