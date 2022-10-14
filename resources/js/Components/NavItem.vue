<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { managePageStore } from "@/stores/ManagePages";

const storePages = managePageStore();
const props = defineProps({
    page: String,
    icon: String,
    active: Boolean,
    disabled: Boolean,
});

const classes = computed(() => {
    return props.active
    ? "bg-gray-600 rounded-xl  py-2 px-3 text-c-orange mt-3"
    : "bg-gray-600 rounded-3xl hover:rounded-xl transition-all duration-100 ease-linear py-2 px-3 text-gray-400 mt-3 hover:text-yellow-500"
});
</script>

<template>
<div class="relative">
    <button
     @click="storePages.setPage(props.page)"
     :disabled="props.disabled"
      :class="classes">
        <i :class="[icon]"></i>
    </button>
    <slot />
</div>

</template>
