<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    currentPage: Number,
    previousPage: String,
    nextPage: String,
});
</script>

<template>
    <div class="flex justify-center items-center p-3">
        <a :href="previousPage" rel="no-refresh">
            <i
            v-if="currentPage != 1"
                class="bi bi-chevron-left text-xl bg-c-orange text-gray-900 hover:bg-gray-500 transition-all duration-1 ease-out hover:text-white px-2 py-1 rounded"
            ></i>
        </a>
        <Transition mode="out-in">
            <div
                class="w-12 rounded mx-5 p-1 text-center text-lg self-end font-medium bg-gray-300"
                v-text="currentPage"
            ></div
        ></Transition>

        <a :href="nextPage" rel="no-refresh">
            <i
            v-if="nextPage != null"
                class="bi bi-chevron-right text-xl bg-c-orange text-gray-900 hover:bg-gray-500 transition-all duration-1 ease-out hover:text-white px-2 py-1 rounded"
            ></i>
        </a>
    </div>
</template>
