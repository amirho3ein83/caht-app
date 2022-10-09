<script setup>
import NotificationItem from "./NotificationItem.vue";
import { onMounted, ref } from "vue";
import { notificationStore } from "@/stores/Notifications";

const useNotificationStore = notificationStore();
const currentMode = ref("light");

onMounted(() => {
    useNotificationStore.getNotifications();
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
 
export default {
  layout: AppLayout
}
</script>
<template>
        <div class="m-4 w-[420px] h-[750px] flex flex-col overflow-y-auto overflow-x-hidden">
            <NotificationItem
                v-for="notification in useNotificationStore.notifications"
                :key="notification.id"
                :notification="notification"
            />
        </div>
</template>
