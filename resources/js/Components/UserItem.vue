<script setup>
import { onMounted, ref } from "vue";
import { useFFStore } from "@/stores/FF";

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
    <Transition >
        <div
            v-if="showItem"
            class="flex justify-start w-80 mx-auto text-gray-700 bg-gray-200 rounded-md p-1 hover:opacity-100 opacity-90 cursor-pointer hover:bg-slate-200"
        >
            <img
                class="h-12 w-12 rounded-full object-cover"
                :src="user.profile"
                v-if="user.profile"
            />

            <p class="flex-1 ml-3 text-center text-lg align-middle self-center">
                {{ user.username }}
            </p>
            <button
            v-if="props.buttonType == `follow`"
                @click="FFStore.follow(user.username)"
                class="text-sm font-normal px-4 hover:bg-indigo-600 bg-indigo-500 rounded text-gray-100 tracking-wide cursor-pointer hover:text-gray-50 transition hover:scale-105"
            >
                Follow
            </button>
            <input
            v-if="props.buttonType == `checkbox`"
                type="checkbox"
                class="accent-pink-500 p-3 m-2 bg-slate-200"
                :value="user.id"
                v-model="FFStore.checkedAccounts"
            />
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
