<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="w-full bg-gray-800 hover:bg-grey-900 text-white text-lg py-2 px-4 font-semibold rounded focus:outline-none focus:shadow-outline h-10"
>
        <slot />
    </button>
</template>
