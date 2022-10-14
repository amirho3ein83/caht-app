<script setup>
import { ref, onMounted } from "vue";
import Spinner from "./Spinner.vue";
import { storeToRefs } from "pinia";
import { useFFStore } from "@/stores/FF";
import LoadingAnimation from "@/Components/LoadingAnimation.vue";
import { managePageStore } from "@/stores/ManagePages";
import { useChatsStore } from "@/stores/Chats.js";

const storeChats = useChatsStore();
const storePages = managePageStore();
const FFStore = useFFStore();
FFStore.fill();

const message = ref("");

const current_tab = ref("followings");

const checkedAccounts = ref([]);

const startBroadcasting = () => {
    
    axios
        .post("message/broadcasting", {
            chosenAccounts: checkedAccounts.value,
            message: message.value,
        })
        .then((response) => {
            storeChats.getMessages(),
            checkedAccounts.value = []
            message.value = ''
        })
        .catch((error) => {
            console.log(error);
        });
};
onMounted(() => {
    storePages.currentSidebar = "BroadCast";
});

const categories = ref({
    followers: FFStore.followers,
    followings: FFStore.followings,
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
        <nav class="mb-3 rounded bg-slate-400 z-20 flex text-lg font-medium justify-center sticky top-0 ">
            <p
                class=" -mb-px border-b border-transparent p-4 cursor-pointer text-gray-900"
                :class="{
                    'bg-gray-600 text-gray-100':
                        current_tab == 'followers' ,
                }"
                @click="current_tab = 'followers'"
            >
                followers
            </p>

            <p
                class=" -mb-px border-b border-transparent p-4 cursor-pointer text-gray-900"
                :class="{
                    'bg-gray-600 text-gray-100':
                        current_tab == 'followings',
                }"
                @click="current_tab = 'followings'"
            >
                followings
            </p>
        </nav>

        <div
            v-if="current_tab == 'followers'"
            v-for="user in FFStore.followers"
            :key="user.id"
            class="flex m-1 mt-2 justify-start w-80 mx-auto text-gray-700 bg-gray-200 rounded-md p-1 hover:opacity-100 opacity-90 cursor-pointer hover:bg-slate-200"
        >
            <img
                class="h-14 w-14 rounded-full object-cover"
                :src="user.profile"
                v-if="user.profile"
            />

            <p class="flex-1 ml-3 text-center text-lg align-middle self-center">
                {{ user.username }}
            </p>
            <input
                type="checkbox"
                class="accent-pink-500 p-3 m-2 bg-slate-200"
                :value="user.id"
                v-model="checkedAccounts"
            />
        </div>

        <div
            v-if="current_tab == 'followings'"
            v-for="user in FFStore.followings"
            :key="user.id"
            class="flex m-1 justify-start w-80 mx-auto text-gray-700 bg-gray-200 rounded-md p-1 hover:opacity-100 opacity-90 cursor-pointer hover:bg-slate-200"
        >
            <img
                class="h-14 w-14 rounded-full object-cover"
                :src="user.profile"
                v-if="user.profile"
            />

            <p class="flex-1 ml-3 text-center text-lg align-middle self-center">
                {{ user.username }}
            </p>
            <input
                type="checkbox"
                class="accent-pink-500 p-3 m-2 bg-slate-200"
                :value="user.id"
                v-model="checkedAccounts"
            />
        </div>
    </div>
    <div class="sticky bottom-0 w-full px-3">
        <div class="flex mb-1 -space-x-4">
            <div class="flex -space-x-4 bg-stone-400 rounded-full">
                <img
                    v-for="account of checkedAccounts"
                    class="w-10 h-10 rounded-full dark:border-gray-800"
                    :src="$page.props.user.profile"
                    alt=""
                />
            </div>
        </div>
        <div class="flex border-gray-200 items-center justify-between">
            <div class="p-1 flex-1 -t dark:border-gray-500">
                <input
                    v-model="message"
                    class="block p-3 pl-10 w-full h-12 text-lg rounded-sm text-gray-900 bg-gray-100 outline-none"
                    placeholder="message..."
                    required
                    @keyup.enter="startBroadcasting()"
                />
            </div>
            <button
            :disabled="checkedAccounts.length == 0"
                prevent-scroll
                @click="startBroadcasting"
                type="button"
                class="text-2xl w-12 h-12 bg-c-orange text-gray-900 transition-all duration-1 ease-out px-2 hover:bg-gray-500 hover:text-white rounded"
                :class="{'opacity-30 hover:bg-c-orange hover:text-gray-900 ':checkedAccounts.length == 0}"
            >
            <i class="bi bi-send-fill cursor-default "></i>
            </button>

        </div>
    </div>
</template>
<style>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
