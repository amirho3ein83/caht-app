<template>
<div class="flex flex-1 flex-end justify-end flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
    <div
    v-if="currentConversation" 
        id="messages"
        class="flex flex-end flex-col-reverse space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch"
    >
        <div v-for="message in messages" :key="message.id">
            <MessageItem :message="message" />
        </div>
    </div>

</div>
<div v-if="currentConversation.length === 0" class="mx-auto mb-5">
           <h3 class="text-slate-900">Please choose one conversation</h3>
</div>


</template>

<script>
import MessageItem from "./MessageItem.vue";

export default {
    components: {
        MessageItem,
    },
    props: ["messages",'currentConversation'],
};
</script>
