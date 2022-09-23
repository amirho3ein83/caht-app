
<script setup>

import { Inertia } from "@inertiajs/inertia";
import { reactive, ref, watch } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import MessageItem from "./MessageItem.vue";
import FollowingDetails from "./FollowingDetails.vue";

import {useChatsStore} from "@/stores/Chats.js" 

const storeChats = useChatsStore()


watch(storeChats.currentChat, (newValue, oldValue) => {
    if (oldValue.id) {
                this.disconenct(oldValue);
            }
            this.connect();
})


let form = reactive({
    text: '',
})
const processing = ref(false);


let sendMessage = () => {

    processing.value = true;

Inertia.post("/chats/" + storeChats.currentChat.id + "/send-message", form,
        {
            onSuccess: () => Promise.all([
            storeChats.getMessages(),
                form.text = '',
                processing.value = false,
                console.log('message sent')
            ]), onFinish: () => {
                processing.value = false,
                    console.log('finish message sent')
            },
        }
    )
}



</script>
        
<template>
<div 
class=" sm:visible flex-1 p:2  justify-between flex flex-col h-screen my-0 bg-gradient-to-b from-gray-400 via-gray-500 to-gray-600">


    <FollowingDetails :class="{ 'invisible': !storeChats.currentChat.id }" :addressee="storeChats.addressee" :currentChat="storeChats.currentChat" />

<div
    class="flex flex-1 flex-end justify-end flex-col space-y-4  overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch"
>
    <div
        id="messages"
        class="flex flex-end flex-col-reverse  space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch"
    >
        <div v-for="message in storeChats.messages" :key="message.id">
            <MessageItem v-on:message-deleted="" :message="message" />
        </div>
    </div>
</div>



<div class="flex justify-between px-4 pt-2 pb-2 bg-gray-500 backdrop-blur-xl" :class="{ 'invisible': !storeChats.currentChat.id }">

    <i class="bi bi-emoji-smile text-yellow-500 mx-2 hover:scale-110 transition duration-60"></i>
    <i class="bi bi-file-earmark-arrow-up text-gray-200 mx-2 hover:scale-110 transition duration-60"></i>

    <input v-model="form.text"  @keyup.enter="sendMessage()" type="text" placeholder="type something ..."
        class="w-72 flex-1 focus:outline-none text-gray-600 0 pl-12 bg-gray-200 focus:ring focus:ring-gray-600 rounded-md py-2" />

    <button :disabled="processing" @click="sendMessage()" prevent-scroll type="button"
        :class="{ 'bg-gray-600': processing }"
        class="inline-flex items-center justify-center rounded-lg px-3 py-2 transition duration-500 ease-in-out text-white hover:bg-gray-600 bg-gray-500 focus:outline-none ml-1">


        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
            class="h-6 w-6 ml-2 transform rotate-90">
            <path
                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
            </path>
        </svg>
    </button>
</div>
</div>
</template>

<style>
    i{
font-size: 27px;
cursor: pointer;
    }
</style>