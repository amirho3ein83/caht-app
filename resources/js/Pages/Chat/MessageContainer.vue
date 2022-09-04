<template>
    <div
        class="flex flex-1 flex-end justify-end flex-col space-y-4  overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch"
    >
        <div
            id="messages"
            class="flex flex-end flex-col-reverse  space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch"
        >
            <div v-for="message in messages" :key="message.id">
                <MessageItem :message="message" />
            </div>
        </div>
    </div>
    <InputMessage
        :conversation="currentConversation"
        v-on:messagesent="getMessages()"
        :class="{'invisible': !currentConversation.id}"
    />
</template>

<script>
import MessageItem from "./MessageItem.vue";
import InputMessage from "./InputMessage.vue";

export default {
    components: {
        MessageItem,
        InputMessage,
    },
    props: ["messages", "currentConversation"],
};
</script>
