<script setup>
import { onMounted, ref } from "vue";
import { useFFStore } from "@/stores/FF";
import { useProfileStore } from "@/stores/Profile.js";

let profileStore = useProfileStore();
let showItem = ref(false);

const props = defineProps({
    user: Object,
    buttonType: String,
});

const FFStore = useFFStore();

onMounted(() => {
    setTimeout(() => {
        showItem.value = true;
    }, 1);
});
</script>

<template>
    <Transition>
        <div
            @click="profileStore.showUserProfile(user.id)"
            v-if="showItem"
            class="flex justify-start w-80 mx-auto text-gray-700 bg-gray-200 rounded-md p-1 hover:opacity-100 opacity-90 cursor-pointer hover:bg-slate-200"
        >
            <img
                class="h-12 w-12 rounded-full object-cover"
                :src="user.profile"
                v-if="user.profile"
            />

            <p class="flex-1 ml-3 text-center text-sm align-middle self-center">
                {{ user.username }}
            </p>
            <button
                v-if="user.follow_back_suggest"
                class="text-sm w-1/4 font-normal px-1 hover:bg-pink-700 bg-pink-600 rounded text-gray-100 tracking-wide cursor-pointer hover:text-gray-50 transition hover:scale-105"
            >
                Follow back
            </button>
            <button
                v-else-if="user.following"
                class="text-sm w-1/4 font-normal px-1 rounded text-yellow-800 tracking-wide"
            >
                Following
            </button>
            <input
                v-else-if="props.buttonType == `checkbox`"
                type="checkbox"
                class="accent-pink-500 rounded-lg p-3 m-2 bg-slate-200"
                :value="user.id"
                v-model="FFStore.checkedAccounts"
            />
            <button
                v-else
                @click="FFStore.follow(user.username)"
                class="text-sm w-1/4 font-normal px-1 hover:bg-indigo-600 bg-indigo-500 rounded text-gray-100 tracking-wide cursor-pointer hover:text-gray-50 transition hover:scale-105"
            >
                Follow
            </button>
        </div>
    </Transition>
</template>

<style>
.slide-fade-leave-active {
    transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>
