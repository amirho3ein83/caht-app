<template>
    <AppLayout title="Chat">
        <div class="flex mx-auto justify-center">
            <div
                class="p:2 sm:py-6 justify-between flex flex-col h-screen max-w-2xl"
            >
                <ContactDetails />

                <MessageContainer :messages="messages" />

                <InputMessage
                    :conversation="currentConversation"
                    v-on:messagesent="getMessages()"
                />
            </div>
            <div
                class="bg-gray-500 py-5 w-60 my-4 rounded-r-md flex-col align-center"
            >
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
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import ConversationItem from "./ConversationItem.vue";
import InputMessage from "./InputMessage.vue";
import MessageItem from "./MessageItem.vue";
import { Link } from "@inertiajs/inertia-vue3";

import ContactDetails from "./ContactDetails.vue";
import MessageContainer from "./MessageContainer.vue";

export default {
    components: {
        AppLayout,
        Welcome,
        MessageContainer,
        ConversationItem,
        InputMessage,
        MessageItem,
        Link,
        ContactDetails,
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
