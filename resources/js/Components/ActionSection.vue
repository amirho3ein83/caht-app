<script setup>
import JetSectionTitle from "./SectionTitle.vue";
</script>

<template>
    <div class="max-w-lg mx-auto">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div
                class="px-4 py-5 sm:p-6 bg-gradient-to-b from-gray-300 via-gray-400 to-gray-500shadow sm:rounded-lg"
            >
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
