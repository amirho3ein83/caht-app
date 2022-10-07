<script setup>
import { ref } from 'vue';
import NotificationItem from './NotificationItem.vue';
import AppLayout from "@/Layouts/AppLayout.vue";

const currentMode = ref('light')

</script>

<template>
    <AppLayout>
        <div class="m-4  w-[420px] ">
            <NotificationItem/>
        </div>
    </AppLayout>
</template>
