<script setup>
import ChatItem from "./ChatItem.vue";
import { useChatsStore } from "@/stores/Chats.js";
import { ref } from "@vue/reactivity";
import { storeToRefs } from "pinia";
import { managePageStore } from "@/stores/ManagePages";
import { onMounted } from "vue";

const storePages = managePageStore();
const storeChats = useChatsStore();

onMounted(() => {
    storeChats.getChats();
    storePages.currentSidebar = "ChatList";
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,
};
</script>
<template>
    <div
        class="main h-full flex flex-col overflow-y-auto overflow-x-hidden w-full"
    >
        <!-- <input
                @keypress="onEnter"
                class="rounded-2xl p-1 mb-4 w-96 text-lg text-gray-900 h-10 bg-gray-300 outline-none focus:bg-gray-200"
                placeholder="           Search Contacts"
            /> -->
        <div class="flex flex-1 flex-end flex-col space-y-4">
            <div
                id="messages"
                class="flex flex-end h-100 flex-col-reverse space-y-4"
            >
                <div>
                    <ChatItem
                        v-for="chat in storeChats.chats"
                        :key="chat.id"
                        :chat="chat"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
