<script setup>
import {useChatsStore} from "@/stores/Chats.js" 

const storeChats = useChatsStore()
const props = defineProps({
    chat: Object,
});

let chatTitle = (username) => {
    props.chat.name = props.chat.name.replace(
        username,
        ""
    );
    return props.chat.name;
};
</script>

<template>
      <div class="select-none cursor-pointer  flex flex-1 items-center p-4  hover:bg-gray-700 "
      :class="{'bg-gradient-to-r from-gray-600 to-gray-700':storeChats.currentChat.id == chat.id}"
      >
        <div class="flex flex-col w-14 h-14 justify-center items-center mr-4">
                    <img class="w-14 h-14 object-cover rounded-full" :src="$page.props.user.profile"
                        v-if="$page.props.user.profile" />
                    <i v-else class="bi bi-person-circle w-10 sm:w-16 h-10 sm:h-16 rounded-full text-gray-600"
                        style="font-size: 39px;"></i>
        </div>
        <div class="flex-1 pl-1">
          <div class="text-gray-300 dark:text-gray-200 text-lg">{{ chatTitle($page.props.user.username) }}</div>
        </div>
        <div class="flex flex-row justify-center">
          <div class="text-gray-200 dark:text-gray-200 text-xs">6:00 AM</div>

        </div>
      </div>
</template>
