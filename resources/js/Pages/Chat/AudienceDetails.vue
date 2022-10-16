<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { useChatsStore } from "@/stores/Chats.js";
import { onMounted, ref } from "vue";

const storeChats = useChatsStore();

let showUser = ref(false);
onMounted(() => {
    setTimeout(() => {
        showUser.value = true;
    }, 1);
});
</script>

<template>
    <Transition>
        <div
            v-if="showUser"
            class="sm:items-center justify-around bg-gray-600 py-1"
        >
            <div class="relative flex items-center space-x-4 justify-between">
                <div class="flex">
                    <div class="sm:hidden p-2">
                        <a>
                            <i
                                class="bi bi-arrow-left-circle-fill text-gray-400"
                            ></i>
                        </a>
                    </div>
                    <div class="flex ml-3">
                        <div class="relative p-1">
                            <div class="relative">
                                <img
                                    class="w-16 h-16 object-cover rounded-full"
                                    :src="storeChats.currentChat.addressee.profile"
                                    v-if="storeChats.currentChat.addressee.profile"
                                />
                                <i
                                    v-else
                                    class="bi bi-person-circle w-10 sm:w-16 h-10 sm:h-16 rounded-full text-gray-600"
                                    style="font-size: 39px"
                                ></i>
                                <template v-if="storeChats.currentChat.addressee.is_online">
                                    <div
                                        class="absolute button-0 right-0 -mr-0 -mt-4 w-4 h-4 rounded-full bg-green-400 animate-ping"
                                    ></div>
                                    <div
                                        class="absolute button-0 right-0 -mr-0 -mt-4 w-4 h-4 rounded-full bg-green-400"
                                    ></div>
                                </template>
                            </div>
                        </div>

                        <div
                            class="flex flex-col leading-tight justify-center ml-2"
                        >
                            <div class="text-xl mt-1 flex items-center">
                                <p
                                    class="text-gray-100 text-2xl mr-3 break-words"
                                >
                                    {{ storeChats.currentChat.addressee.username }}
                                </p>
                            </div>
                            <span
                                v-if="storeChats.currentChat.addressee.is_online"
                                class="text-lg text-gray-100"
                                >online
                            </span>
                            <span
                                v-if="storeChats.currentChat.addressee.is_typing"
                                class="text-lg text-gray-100"
                                >typing...
                            </span>
                        </div>
                    </div>
                </div>

                <Dropdown align="right" width="48">
                    <template #trigger>
                        <i
                            class="mr-5 bi bi-three-dots-vertical text-3xl text-gray-200"
                        ></i>
                    </template>

                    <template #content>
                        <!-- Account Management -->
                        <!-- <div
                                        class="block px-4 py-2 text-xs text-gray-400"
                                    >
                                        Manage Account
                                    </div> -->

                        <button
                            class="px-4 align-baseline py-2 text-lg w-full justify-between hover:bg-gray-600 hover:text-gray-300 flex transition"
                        >
                            Search
                            <i class="bi bi-search"></i>
                        </button>
                        <button
                            v-if="storeChats.currentChat.is_muted"
                            @click="storeChats.unmuteChat"
                            class="px-4 align-baseline py-2 text-lg w-full justify-between hover:bg-gray-600 hover:text-gray-300 flex transition"
                        >
                            unMute
                            <i
                                class="bi bi-volume-mute-fill text-slate-700 text-center"
                            ></i>
                        </button>
                        <button
                            v-else
                            @click="storeChats.muteChat"
                            class="px-4 align-baseline py-2 text-lg w-full justify-between hover:bg-gray-600 hover:text-gray-300 flex transition"
                        >
                            Mute
                            <i
                                class="bi bi-volume-mute-fill text-slate-700 text-center"
                            ></i>
                        </button>
                        <button
                            @click="storeChats.deleteChat"
                            class="px-4 align-baseline py-2 text-lg w-full justify-between hover:bg-gray-600 hover:text-gray-300 flex transition"
                        >
                            Delete Chat
                            <i class="bi bi-trash3 text-red-400"></i>
                        </button>

                        <button
                            v-if="!storeChats.currentChat.is_blocked"
                            @click="storeChats.blockContact"
                            class="px-4 align-baseline py-2 text-lg w-full justify-between hover:bg-gray-600 hover:text-gray-300 flex transition"
                        >
                            Block
                            <i class="bi bi-slash-circle bold text-red-400"></i>
                        </button>
                    </template>
                </Dropdown>
            </div>
        </div>
    </Transition>
</template>
<style>
i {
    font-size: 25px;
}
</style>
