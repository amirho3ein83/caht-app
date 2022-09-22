<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
const props = defineProps({
    addressee: Object,
    currentChat: Object,
});

const blockContact = () => {
    axios.patch('block/' + props.addressee.username);
}

const deleteChat = () => {
    axios.delete('chats/' + props.currentChat.id +'/'+props.addressee.id);
}
</script>

<template>
    <div class="sm:items-center justify-around bg-gray-600 py-1">
        <div class="relative flex items-center space-x-4 justify-between">
            <div class="flex">
                <div class="sm:hidden p-2">
                    <a>
                        <i class="bi bi-arrow-left-circle-fill text-gray-400" style="font-size: 37px"></i>
                    </a>
                </div>
                <div class="flex ml-3">
                    <div class="relative p-1">
                        <div class="relative">
                            <img class="w-10 sm:w-16 h-10 sm:h-16 rounded-full" :src="addressee.profile"
                                v-if="addressee.profile" />
                            <i v-else class="bi bi-person-circle w-10 sm:w-16 h-10 sm:h-16 rounded-full text-gray-600"
                                style="font-size: 39px"></i>
                            <template v-if="addressee.is_online">
                                <div
                                    class="absolute button-0 right-0 -mr-0 -mt-4 w-4 h-4 rounded-full bg-green-400 animate-ping">
                                </div>
                                <div class="absolute button-0 right-0 -mr-0 -mt-4 w-4 h-4 rounded-full bg-green-400">
                                </div>
                            </template>
                        </div>
                    </div>
                    <div class="flex flex-col leading-tight justify-center ml-2">
                        <div class="text-xl mt-1 flex items-center">
                            <span class="text-gray-100 mr-3 break-words">{{ addressee.username }}
                            </span>
                        </div>
                        <span v-if="addressee.is_online" class="text-sm text-gray-100">online
                        </span>
                        <span v-if="addressee.is_typing" class="text-sm text-gray-100">typing...
                        </span>
                    </div>
                </div>
            </div>


            <Dropdown align="right" width="48">
                <template #trigger>
                    <i class="mr-4 bi bi-three-dots-vertical text-gray-200" style="font-size: 20px"></i>
                </template>

                <template #content>
                    <!-- Account Management -->
                    <!-- <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Manage Account
                                </div> -->

                    <button
                        class=" mx-auto py-2 text-sm text-gray-800 w-full hover:bg-gray-600 hover:text-gray-300 block transition">
                        Mute Chat
                    </button>

                    <button @click="deleteChat"
                        class="mx-auto py-2 text-sm justify-evenly w-full hover:bg-gray-600 hover:text-gray-300 block transition">
                        Delete Chat
                        <i class="bi bi-trash3 text-red-400 text-lg"></i>
                    </button>

                    <button @click="blockContact"
                        class="mx-auto align-baseline py-2 text-sm w-full  justify-evenly hover:bg-gray-600 hover:text-gray-300 flex transition">
                        Block
                        <i class="bi bi-slash-circle bold text-xl text-red-400 "></i>
                    </button>

                    <button
                        class="mx-auto py-2 text-sm text-gray-800 w-full hover:bg-gray-600 hover:text-gray-300 block transition">
                        Mute Chat
                    </button>
                </template>
            </Dropdown>
        </div>
    </div>
</template>
