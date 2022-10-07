<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

const currentMode = ref("light");
</script>

<template>
    <AppLayout>
        <div class="m-4 w-[420px] ">
            <i
                @click="currentMode == 'light'"
                v-if="currentMode == 'light'"
                class="bi bi-brightness-low text-c-orange text-3xl"
            ></i>
            <i
                @click="currentMode == 'dark'"
                v-if="currentMode == 'dark'"
                class="bi bi-moon-stars text-c-orange"
            ></i>
        </div>
    </AppLayout>
</template>
