<template>
    <AppLayout title="Chat">
        <div class="flex mx-auto justify-center">
            <div
                class="p:2 sm:py-6 justify-between flex flex-col h-screen max-w-2xl my-4 bg-gradient-to-b from-gray-200 via-gray-500 to-gray-600"
            >
                <ContactDetails />

                <MessageContainer :messages="messages" />
                <InputMessage
                    :conversation="currentConversation"
                    v-on:messagesent="getMessages()"
                />
            </div>
            <div></div>
            <div
                class="bg-gradient-to-b from-gray-700 to-gray-600 bg-gradient-to-r py-5 w-60 my-4 rounded-r-md flex-col align-center"
            >
                <div
                    class="pb-3 justify-around relative flex items-center space-x-4"
                >
                    <a href="user/profile">
                        <div class="justify-center hover:cursor-pointer">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-17 w-17 object-cover">


                            <span class="text-gray-100 text-sm mr-3">
                                {{ $page.props.user.name }}
                            </span>
                        </div>
                    </a>
                    <div class="flex leading-tight">
                        <i
                            class="text-slate-50 bi bi-person-lines-fill"
                            style="font-size: 25px"
                        ></i>
                    </div>
                </div>
                <div class="relative">
                    <div
                        class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
                    >
                        <svg
                            aria-hidden="true"
                            class="w-5 h-5 text-gray-500 dark:text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            ></path>
                        </svg>
                    </div>
                    <input
                        type="search"
                        id="default-search"
                        class="block p-2 pl-10 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500"
                        placeholder="Search Mockups, Logos..."
                        required
                    />
                </div>
                <ConversationItem
                    v-for="conversation in conversations"
                    :key="conversation"
                    :conversation="conversation"
                    :currentConversation="currentConversation"
                    v-on:roomChanged="setConversation($event)"
                />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import BootstrapIcon from "@dvuckovic/vue3-bootstrap-icons";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import ConversationItem from "./ConversationItem.vue";
import InputMessage from "./InputMessage.vue";
import MessageItem from "./MessageItem.vue";
import { Link } from "@inertiajs/inertia-vue3";

import ContactDetails from "./ContactDetails.vue";
import MessageContainer from "./MessageContainer.vue";

export default {
    props:["user"],
    components: {
        AppLayout,
        Welcome,
        MessageContainer,
        ConversationItem,
        InputMessage,
        MessageItem,
        Link,
        ContactDetails,
        BootstrapIcon,
    },
    data: function () {
        return {
            conversations: [],
            currentConversation: [],
            messages: [],
            contact: [],
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
                .get(route("conversations"))
                .then((response) => {
                    this.conversations = response.data;
                    this.setConversation(response.data[0]);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        userProfile() {
            axios.get("user/profile");
        },
        getMessages() {
            axios
                .get(
                    "/chat/conversation/" +
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
            this.currentConversation = conversation;
            this.contact = this.currentConversation.group_members[0]
                ? this.$page.props.user
                : this.currentConversation.group_members[2];
        },
    },
    created() {
        this.getConversations();
    },
};
</script>
