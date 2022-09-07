<script>


import AppLayout from "@/Layouts/AppLayout.vue";
import ConversationItem from "./ConversationItem.vue";
import MessageItem from "./MessageItem.vue";
import { Link } from "@inertiajs/inertia-vue3";

import ContactDetails from "./ContactDetails.vue";
import MessageContainer from "./MessageContainer.vue";
import UserInfo from "./UserInfo.vue";

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
<!-- <script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import ConversationItem from "./ConversationItem.vue";
import ContactDetails from "./ContactDetails.vue";
import MessageContainer from "./MessageContainer.vue";
import UserInfo from "./UserInfo.vue";
import { onMounted, watch } from "vue";




const props = defineProps({
    conversations: Object,
    currentConversation: Object,
    messages: Object,
    current_contact: Object,
    second_contact: Object,
})

watch(props.currentConversation, (newValue, oldValue) => {
    if (oldValue.id) {
        disconenct(oldValue);
    }
    connect();
})


let getConversations = () => {
    axios
        .post(
            route("conversations", {
                contactId: this.$page.props.user.id,
            })
        )
        .then((response) => {
            props.conversations = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
};
let getMessages = () => {
    axios
        .get(
            "/chat/conversations/" +
            props.currentConversation.id +
            "/messages"
        )
        .then((response) => {
            props.messages = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
};
let setConversation = (conversation) => {
    axios
        .post("get/contact/", { username: conversation.second_contact })
        .then((response) => {
            props.second_contact = response.data[0];
        })
        .catch((error) => {
            console.log(error);
        });

    props.currentConversation = conversation;
};

let connect = () => {
    if (props.currentConversation.id) {
        getMessages();
        window.Echo.private(
            "chat." + props.currentConversation.id
        ).listen(".message", (e) => {
            getMessages();
        });
    }
};

let noConversation = () => {
    // return props.conversations.length != 0 ? false : true;
};


let disconenct = (conversation) => {
    window.Echo.leave("chat." + conversation.id);

};

onMounted(() => {
    getConversations()

    // online user
    axios
        .post("/member/" + this.$page.props.contact.id + "/online")
        .then((response) => {
            console.log('ur online');
        })
        .catch((error) => {
            console.log(error);
        });
})

</script>
             -->
<template>
    <AppLayout>
        <div class="flex mx-auto justify-center">

            <div class="bg-gradient-to-b from-gray-700 to-gray-600 py-5 w-60 my-0 flex-col align-center"
                style="width: 400px;">

                <UserInfo />

                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input
                        class="block p-2 mb-4 pl-10 w-full text-sm text-gray-900 bg-gray-100 border border-gray-300 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500"
                        placeholder="Search Contacts" />
                </div>

                <div
                    class= " flex flex-1 flex-end flex-col space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                    <div id="messages"
                        class="flex flex-end h-100 flex-col-reverse space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                        <div >
                            <template v-for="conversation in conversations" :key="conversation.id">
                                <ConversationItem v-if="conversation" :conversation="conversation"
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
                <ContactDetails :second_contact="second_contact" v-if="currentConversation.id"/>
<h2 class="mx-auto animate-pulse" v-else>Let's start by choosing one conversation</h2>
                <MessageContainer :currentConversation="currentConversation" :messages="messages" />
            </div>
        </div>
    </AppLayout>
</template>
