
<script setup>

import { Inertia } from "@inertiajs/inertia";
import { reactive, ref, watch } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import MessageItem from "./MessageItem.vue";

const props = defineProps({
    messages: Object,
    currentConversation: Object
})

let getMessages = () => {
axios
    .get(
        "/chat/conversations/" +
        props.currentConversation.id +
        "/messages"
    )
    .then((response) => {
        console.log('ssss');
        props.messages = response.data;
    })
    .catch((error) => {
        console.log(error);
    });
};



let form = reactive({
    text: '',
})
const processing = ref(false);


let sendMessage = () => {

    processing.value = true;
    form.from = props.currentConversation.pivot.contact_id
    Inertia.post("/chat/conversations/" + props.currentConversation.id + "/message", form,
        {
            onSuccess: () => Promise.all([
                getMessages(),
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



    <div class="flex justify-between px-4 pt-4 mb-2 sm:mb-0" :class="{ 'invisible': !currentConversation.id }">
        <input v-model="form.text" @keyup.enter="sendMessage()" type="text" placeholder="..."
            class="w-72 flex-- focus:outline-none text-gray-600 0 pl-12 bg-gray-200 focus:ring focus:ring-gray-600 rounded-md py-2" />

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
</template>

