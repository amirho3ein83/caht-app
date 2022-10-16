<script setup>
import { useChatsStore } from "@/stores/Chats.js";
import { onMounted, ref } from "vue";
import { TransitionRoot } from "@headlessui/vue";

let showItem = ref(false);

const storeChats = useChatsStore();
const props = defineProps({
    chat: Object,
});

onMounted(() => {
    setTimeout(() => {
        showItem.value = true;
    }, 1);
});
</script>

<template>
    <Transition name="slide-fade">
        <div
            @click="storeChats.setChat(chat)"
            v-if="showItem"
            class="group  px-1 select-none border-b border-gray-700 justify-between cursor-pointer flex flex-1 items-center p-2 hover:bg-gray-700 transition duration-110 ease-out"
            :class="{
                'bg-gradient-to-r from-gray-600 to-gray-700':
                    storeChats.currentChat.id == chat.id,
            }"
        >
            <div class="flex items-center p-1">
                <div class="w-12 h-12 mr-4">
                    <img
                        class="w-12 h-12 object-cover rounded-full"
                        :src="$page.props.user.profile"
                        v-if="$page.props.user.profile"
                    />
                    <i
                        v-else
                        class="bi bi-person-circle w-10 sm:w-16 h-10 sm:h-16 rounded-full text-gray-600"
                        style="font-size: 39px"
                    ></i>
                </div>
                <div>
                    <div class="flex-1 pl-1">
                        <div class="text-yellow-500 dark:text-gray-200 text-lg">
                            {{ chat.addressee.username }}
                        </div>
                    </div>
                    <p class="text-white text-xs">
                        Lorem ipsum dolor sit amet.
                    </p>
                </div>
            </div>
            <!-- <div class="flex flex-row justify-center">
                <div class="text-gray-200 dark:text-gray-200 text-xs">
                    <p
                        v-if="chat.is_blocked"
                        :class="{
                            'text-gray-900 dark:text-gray-900': chat.is_blocked,
                        }"
                    >
                    </p>

                </div>
            </div> -->
            <!-- <p v-for="user in chat.users" v-text="user.id"></p> -->
            <div class="flex flex-col py-1 items-center gap-1">
                <template v-if="chat.is_blocked">
                    <span
                        @click="storeChats.unBlockContact(chat.addressee.id)"
                        class="text-lg font-medium text-red-500 duration-150 transition active:scale-100 hover:scale-125 hover:shadow-xl focus:outline-none focus:ring active:text-green-500"
                    >
                        <i
                            class="bi bi-slash-circle group-hover:animate-pulse font-bold text-xl px-3"
                        ></i>
                    </span>
                </template>
                <template v-else-if="chat.is_muted">
                    <span class="text-center">
                        <p class="text-white text-[10px]">4:42 PM</p>
                        <i
                            class="bi bi-volume-mute-fill text-cyan-500 text-center text-lg"
                        ></i>
                    </span>
                </template>
                <template v-else>
                    <p class="text-white text-[10px]">4:42 PM</p>
                    <!-- <i class="bi bi-3-circle-fill text-green-500 text-center pb-0"></i> -->
                    <template
                        v-if="
                            chat.unread_messages_count != 0 &&
                            chat.unread_messages_count != undefined
                        "
                    >
                        <span
                            class="bg-green-500 text-gray-900 text-center rounded-full w-6 h-6 p-0 m-0"
                        >
                            <span class="text-sm text-center font-bold">{{
                                chat.unread_messages_count
                            }}</span>
                        </span>
                    </template>
                </template>
            </div>
        </div>
    </Transition>
</template>
