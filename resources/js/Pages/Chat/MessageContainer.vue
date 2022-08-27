<template>
    <div
        id="messages"
        class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch"
    >
        <template v-for="message in messages" :key="message.id">
            <MessageItem :message="message" />
        </template>
    </div>
</template>

<script>
import MessageItem from "./MessageItem.vue";

export default {
    components: {
        MessageItem,
    },
    props: ["messages"],
};
</script>
