<script setup>
import { ref, onMounted } from "vue";
import Spinner from "./Spinner.vue";
import { storeToRefs } from "pinia";
import { useFFStore } from "@/stores/FF";
import LoadingAnimation from "@/Components/LoadingAnimation.vue";
import { managePageStore } from "@/stores/ManagePages";
import { useChatsStore } from "@/stores/Chats.js";
import SendButton from "../../Components/SendButton.vue";
import UserItem from "../../Components/UserItem.vue";

const storeChats = useChatsStore();
const storePages = managePageStore();
const FFStore = useFFStore();
FFStore.fill();

const message = ref("");

const current_tab = ref("followings");

const startBroadcasting = () => {
    axios
        .post("message/broadcasting", {
            chosenAccounts: FFStore.checkedAccounts,
            message: message.value,
        })
        .then((response) => {
            storeChats.getMessages(), (FFStore.checkedAccounts = []);
            message.value = "";
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
        <nav
            class="mb-3 rounded bg-slate-400 z-20 flex  font-medium justify-center sticky top-0"
        >
            <p
                class="-mb-px border-b border-transparent p-2 cursor-pointer text-gray-900"
                :class="{
                    'bg-gray-600 text-gray-100': current_tab == 'followers',
                }"
                @click="current_tab = 'followers'"
            >
                followers
            </p>

            <p
                class="-mb-px border-b border-transparent p-2 cursor-pointer text-gray-900"
                :class="{
                    'bg-gray-600 text-gray-100': current_tab == 'followings',
                }"
                @click="current_tab = 'followings'"
            >
                followings
            </p>
        </nav>

        <UserItem
            v-if="current_tab == 'followers'"
            v-for="user in FFStore.followers"
            :key="user.id"
            :user="user"
            :buttonType="`checkbox`"
            class="flex mt-1 justify-start w-80 mx-auto text-gray-700 bg-gray-200 rounded-md p-1 hover:opacity-100 opacity-90 cursor-pointer hover:bg-slate-200"
        />
        <UserItem
            v-if="current_tab == 'followings'"
            v-for="user in FFStore.followings"
            :key="user.id"
            :user="user"
            :buttonType="`checkbox`"
            class="flex mt-1 justify-start w-80 mx-auto text-gray-700 bg-gray-200 rounded-md p-1 hover:opacity-100 opacity-90 cursor-pointer hover:bg-slate-200"
        />
    </div>
    <div class="sticky bottom-0 w-full ">
        <div class="flex mb-1 -space-x-4">
            <div class="flex -space-x-4 bg-stone-400 rounded-full">
                <img
                    v-for="account of FFStore.checkedAccounts"
                    class="w-8 h-8 rounded-full dark:border-gray-800"
                    :src="$page.props.user.profile"
                    alt=""
                />
            </div>
        </div>

        <div class="flex border-gray-200 items-center justify-between">
            <div class="p-1 flex-1 -t dark:border-gray-500">
                <input
                    v-model="message"
                    class="block p-1 pl-10 w-full h-10 text-lg rounded-lg text-gray-900 bg-gray-100 outline-none"
                    placeholder="message..."
                    required
                    @keyup.enter="startBroadcasting()"
                />
            </div>

            <SendButton
                type="button"
                @click="startBroadcasting()"
                :disabled="FFStore.checkedAccounts.length == 0"
                class="bg-yellow-600 p-1"
                :class="{
                    'opacity-30 hover:bg-c-orange hover:text-gray-900 ':
                        FFStore.checkedAccounts.length == 0,
                }"
            />
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
