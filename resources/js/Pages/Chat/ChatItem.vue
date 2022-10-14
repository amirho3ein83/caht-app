<script setup>
import { useChatsStore } from "@/stores/Chats.js";
import { onMounted, ref } from "vue";
import { TransitionRoot } from "@headlessui/vue";



let showItem = ref(false);

const storeChats = useChatsStore();
const props = defineProps({
    chat: Object,
});



let chatTitle = (username) => {
    props.chat.name = props.chat.name.replace(username, "");
    return props.chat.name;
};


onMounted(() => {
    setTimeout(() => {
        showItem.value = true;
    }, 50);
});
</script>

<template>
    <Transition name="slide-fade">
        <div
        @click="storeChats.setChat(chat)"

            v-if="showItem"
            class="group select-none justify-between cursor-pointer flex flex-1 items-center p-4 hover:bg-gray-700 transition duration-110 ease-out"
            :class="{
                'bg-gradient-to-r from-gray-600 to-gray-700':
                    storeChats.currentChat.id == chat.id,
            }"
        >
            <div class="flex items-center"
            >
                <div class="w-14 h-14 mr-4">
                    <img
                        class="w-14 h-14 object-cover rounded-full"
                        :src="$page.props.user.profile"
                        v-if="$page.props.user.profile"
                    />
                    <i
                        v-else
                        class="bi bi-person-circle w-10 sm:w-16 h-10 sm:h-16 rounded-full text-gray-600"
                        style="font-size: 39px"
                    ></i>
                </div>
                <div class="flex-1 pl-1">
                    <div class="text-gray-300 dark:text-gray-200 text-lg">
                        {{ chatTitle($page.props.user.username) }}
                    </div>
                </div>
            </div>
            <!-- <div class="flex flex-row justify-center">
                <div class="text-gray-200 dark:text-gray-200 text-xs">
                    <p
                        v-if="chat.is_blocked"
                        :class="{
                            'text-gray-900 dark:text-gray-900': chat.is_blocked,
                        }"
                    >
                    </p>

                </div>
            </div> -->
<!-- <p v-for="user in chat.users" v-text="user.id"></p> -->
            <template v-if="chat.is_blocked">
                <span
                    @click="storeChats.unBlockContact(chat.addressee.id)"
                    class="text-sm font-medium text-red-500 duration-150 transition active:scale-100 hover:scale-125 hover:shadow-xl focus:outline-none focus:ring active:text-green-500"
                >
                    <i class="bi bi-slash-circle group-hover:animate-pulse font-bold text-3xl "></i>
                </span>
            </template>
            <p class="text-white" v-else>6:00 AM</p>
        </div>
    </Transition>
</template>
