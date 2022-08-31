<template>
    <AppLayout title="Chat">
        <div class="flex mx-auto justify-center">
            <div
                class="p:2 sm:py-4 justify-between flex flex-col h-screen max-w-2xl my-0 bg-gradient-to-b from-gray-400 via-gray-500 to-gray-600"
            >
                <ContactDetails
                    :second_contact="second_contact"
                    v-if="second_contact.length !== 0"
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
                <InputMessage
                    :conversation="currentConversation"
                    v-on:messagesent="getMessages()"
                />
            </div>
            <div></div>
            <div
                class="bg-gradient-to-b from-gray-700 to-gray-600 py-5 w-60 my-0 flex-col align-center"
            >
                <UserInfo />
                <ContactSearchbox v-on:filter="getConversations($event)" />

                <ConversationItem
                    v-for="conversation in conversations"
                    :key="conversation"
                    :conversation="conversation"
                    v-on:roomChanged="setConversation($event)"
                />
            </div>
        </div>
    </AppLayout>
</template>

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
        getConversations(filter) {
            axios
                .get(
                    route("conversations", {
                        search: filter,
                        userId: this.$page.props.user.id,
                    })
                )
                .then((response) => {
                    this.conversations = response.data;
                    // this.setConversation(response.data[0]);
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
            this.current_contact = this.currentConversation.group_members[0]
                ? this.$page.props.user
                : this.currentConversation.group_members[1];

            if (
                this.current_contact ==
                this.currentConversation.group_members[0]
            ) {
                this.second_contact =
                    this.currentConversation.group_members[1] ??
                    this.currentConversation.name;
                this.current_contact =
                    this.currentConversation.group_members[0] ??
                    this.currentConversation.name;
            } else {
                this.second_contact =
                    this.currentConversation.group_members[0] ??
                    this.currentConversation.name;
                this.current_contact =
                    this.currentConversation.group_members[1] ??
                    this.currentConversation.name;
            }
        },
    },
    created() {
        this.getConversations();
        console.log('user is online');

        // online user hiself
        axios
            .post("/member/" + this.$page.props.user.id + "/online")
            .then((response) => {})
            .catch((error) => {
                console.log(error);
            });
    },

    // offline user when left app
    // unmounted() {
    //     console.log('user left');
    //     // offline user hiself
    //     axios
    //         .post("/member/" + this.$page.props.user.id + "/offline")
    //         .then((response) => {})
    //         .catch((error) => {
    //             console.log(error);
    //         });
    // },
};
</script>
