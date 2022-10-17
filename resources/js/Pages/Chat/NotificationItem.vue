<script setup>
import { onMounted, ref } from "vue";
import { notificationStore } from "@/stores/Notifications";

let showItem = ref(false);

const props = defineProps({
    notification: Object,
});

const deleteNotification = (id) => {
    showItem.value = false;
    setTimeout(() => {
        useNotificationStore.deleteNotification(id);
    }, 500);
    useNotificationStore.unreadNotifications =
        --useNotificationStore.unreadNotifications;
};
const playSound = () => {
    // var audio = new Audio("./sounds/1.mp3");
    // audio.play();
    document.getElementById("sound").play();
};

const useNotificationStore = notificationStore();

onMounted(() => {
    setTimeout(() => {
        showItem.value = true;
    }, 1);
});
</script>

<template>
    <Transition>
        <div
            class="w-full relative px-0 py-1 group text-gray-900 bg-gray-300 rounded shadow dark:bg-gray-800 dark:text-gray-300"
            v-if="showItem && typeof notification != `number`"
            role="alert"
            :class="{ 'bg-green-300': notification.read_at == 0 }"
            @click="playSound()"
        >
            <audio id="sound" class="hidden">
                <source src="./sounds/3.mp3" type="audio/mpeg" />
                oops
            </audio>
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-between pt-1">
                    <img
                        class="w-12 h-12 object-cover rounded-full"
                        :src="$page.props.user.profile"
                        alt="Jese Leos image"
                    />
                    <div class="ml-3 font-normal px-4 text-left">
                        <p class="text-sm text-amber-900">
                            {{ notification.writer }}
                        </p>
                        <div class="text-sm font-normal">
                            <p class="break-words">
                                {{ notification.message }}
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class=" absolute right-2 top-2  group-hover:block hidden mb-3 self-center items-end"
                >
                    <svg
                        @click="deleteNotification(notification.id)"
                        aria-hidden="true"
                        class="w-5 h-5  text-red-500 hover:scale-110 transition-all duration-150 ease-linear"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>
            </div>
            <span
                class="text-xs absolute right-2 bottom-0 font-medium text-blue-600 dark:text-blue-500"
                >{{ notification.created_at }}</span
            >
        </div>
    </Transition>
</template>

<style>
.slide-fade-leave-active {
    transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>
