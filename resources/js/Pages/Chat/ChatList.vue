<script setup>
import ChatItem from "./ChatItem.vue";
import { useChatsStore } from "@/stores/Chats.js";
import { ref } from "@vue/reactivity";
import { storeToRefs } from "pinia";
import AppLayout from "@/Layouts/AppLayout.vue";

const storeChats = useChatsStore();

storeChats.getChats();
</script>

<template>

    <AppLayout>
        <div class="m-4 w-[420px]  ">
            <input
                @keypress="onEnter"
                class="rounded-2xl p-1 mb-4 w-96 text-lg text-gray-900 h-10 bg-gray-300 outline-none focus:bg-gray-200"
                placeholder="           Search Contacts"
            />

            <div
                class="flex flex-1 flex-end flex-col space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch"
            >
                <div
                    id="messages"
                    class="flex flex-end h-100 flex-col-reverse space-y-4 overflow-x-hidden overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch"
                >
                    <div>
                        <ChatItem
                            @click="storeChats.setChat(chat)"
                            v-for="chat in storeChats.chats"
                            :key="chat.id"
                            :chat="chat"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
