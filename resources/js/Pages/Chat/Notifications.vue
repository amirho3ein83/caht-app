<script setup>
import NotificationItem from "./NotificationItem.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { onMounted, ref } from "vue";
import { notificationStore } from "@/stores/Notifications";

const useNotificationStore = notificationStore();
const currentMode = ref("light");

onMounted(() => {
    useNotificationStore.getNotifications();
});
</script>

<template>
    <AppLayout>
        <div class="m-4 w-[420px] h-[750px] flex flex-col overflow-y-auto overflow-x-hidden">
            <NotificationItem
                v-for="notification in useNotificationStore.notifications"
                :key="notification.id"
                :notification="notification"
            />
        </div>
    </AppLayout>
</template>
