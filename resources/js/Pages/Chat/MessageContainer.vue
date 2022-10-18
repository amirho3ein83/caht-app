<script setup>
import { Inertia } from "@inertiajs/inertia";
import { reactive, onMounted, ref, watch } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import MessageItem from "./MessageItem.vue";
import FollowingDetails from "./AudienceDetails.vue";

import { useChatsStore } from "@/stores/Chats.js";
import SendButton from "../../Components/SendButton.vue";
let showContainer = ref(false);

const storeChats = useChatsStore();

watch(storeChats.currentChat, (newValue, oldValue) => {
    if (oldValue.id) {
        this.disconenct(oldValue);
    }
    this.connect();
});

let form = reactive({
    text: "",
});
const processing = ref(false);

let sendMessage = () => {
    processing.value = true;

    if (form.text != "") {
        Inertia.post(
            "/chats/" + storeChats.currentChat.id + "/send-message",
            form,
            {
                onSuccess: () =>
                    Promise.all([
                        storeChats.getMessages(),
                        (form.text = ""),
                    ]),
                onFinish: () => {
                    processing.value = false;
                },
            }
        );
    }
};

onMounted(() => {
    setTimeout(() => {
        showContainer.value = true;
    }, 1);
});
</script>

<template>
    <div
        v-if="storeChats.currentChat.id"
        class="sm:visible overflow-x-hidden flex-1 p:2 justify-between flex flex-col h-screen my-0 bg-gradient-to-b from-gray-400 via-gray-500 to-gray-600"
    >
        <FollowingDetails
            :class="{ invisible: !storeChats.currentChat.id }"
            :addressee="storeChats.addressee"
            :currentChat="storeChats.currentChat"
        />

        <div
            class="flex flex-1 flex-end justify-end flex-col space-y-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch"
        >
            <div
                id="messages"
                class="flex flex-end flex-col-reverse space-y-2 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch"
            >
                <div v-for="message in storeChats.messages" :key="message.id">
                    <Transition>
                        <MessageItem v-if="showContainer" :message="message" />
                    </Transition>
                </div>
            </div>
        </div>

        <div
            class="flex justify-between px-4 pt-2 pb-2 bg-gray-500 backdrop-blur-xl"
            :class="{ invisible: !storeChats.currentChat.id }"
        >
            <i
                class="text-2xl self-center bi bi-emoji-smile text-yellow-500 mx-2 hover:scale-110 transition duration-60"
            ></i>
            <i
                class="text-2xl self-center bi bi-file-earmark-arrow-up text-gray-200 mx-2 hover:scale-110 transition duration-60"
            ></i>

            <input
                v-model="form.text"
                @keyup.enter="sendMessage()"
                type="text"
                placeholder="type something ..."
                class="w-72 flex-1 focus:outline-none text-lg text-gray-600 0 pl-12 bg-gray-200 focus:ring focus:ring-gray-600 rounded-md py-2"
            />

            <SendButton
                @click="sendMessage()"
                :disabled="processing"
                :class="{ 'bg-gray-600': processing }"
            />
        </div>
    </div>
    <div class="w-full h-screen" v-else>
        <Transition>
            <img
                class="w-full object-cover overflow-hidden opacity-60 h-screen"
                src="./pics/bgg.png"
                alt=""
            />
        </Transition>
    </div>
</template>

<style>
i {
    cursor: pointer;
}
</style>
