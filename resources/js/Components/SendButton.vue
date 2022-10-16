<script setup>
defineProps({
    on: Boolean,
});
</script>

<template>
    <button
        prevent-scroll
        type="button"
        class="group inline-flex items-center justify-center rounded-lg px-1 py-2 cursor-pointer transition duration-200 ease-in-out text-white hover:bg-gray-600 bg-gray-500 focus:outline-none ml-1"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            fill="currentColor"
            class="h-7 w-7 ml-2 transform rotate-90 group-hover:rotate-45 group-hover:-translate-y-1 transition duration-100 ease-in"
        >
            <path
                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"
            ></path>
        </svg>
    </button>
</template>
