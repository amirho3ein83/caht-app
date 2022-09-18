<script setup>
import ChatItem from "./ChatItem.vue";
import {useGetChatsStore} from "@/stores/getChats.js" 
import { ref } from "@vue/reactivity";

const storeGetChats = useGetChatsStore()

storeGetChats.getChats();


const chats = ref(storeGetChats.chats)

// let chatTitle = (username) => {
//     props.chat.following = props.chat.name.replace(
//         username,
//         ""
//     );
//     return props.chat.following;
// };

</script>

<template>
        <div class="m-4" >

                <input
                    class=" rounded-2xl p-1 mb-4 w-96 text-lg text-gray-900 h-10 bg-gray-300 outline-none focus:bg-gray-200"
                    placeholder="           Search Contacts" />



            <div
                class=" flex flex-1 flex-end flex-col space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                <div id="messages"
                    class="flex flex-end h-100 flex-col-reverse space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                    <div>

                        <!-- <p v-for="chat in chats" :key="chat">{{ chat}}</p> -->
                        <div v-for="chat in chats" :key="chat.id">
                            <ChatItem  :chat="chat" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
</template>
