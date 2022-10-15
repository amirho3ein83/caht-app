<script setup>
import NotificationItem from "./NotificationItem.vue";
import { onMounted, ref } from "vue";
import { notificationStore } from "@/stores/Notifications";
import { managePageStore } from "@/stores/ManagePages";

const storePages = managePageStore();
const useNotificationStore = notificationStore();
const currentMode = ref("light");

onMounted(() => {
    useNotificationStore.getNotifications();
    storePages.currentSidebar = "Notifications";
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,
};
</script>
<template>
    <div
        class="main h-full flex flex-col overflow-y-auto overflow-x-hidden w-full"
    >
        <!-- <div
            v-if="useNotificationStore.unreadNotifications != 0"
            class="text-gray-50 text-xl animate-bounce text-center w-full p-2"
        >
            new
        </div> -->
        <NotificationItem
            v-for="notification in useNotificationStore.notifications"
            :key="notification.id"
            :notification="notification"
        />
    </div>
</template>
