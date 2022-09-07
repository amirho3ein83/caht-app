<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
const props = defineProps({
    second_contact: Object,
});
</script>

<template>
    <div class="sm:items-center justify-around bg-gray-600 py-1">
        <div class="relative flex items-center space-x-4 justify-center">
            <div class="absolute left-3 sm:hidden">
                <a>
                    <i
                        class="bi bi-arrow-left-circle-fill text-gray-400"
                        style="font-size: 37px"
                    ></i>
                </a>
            </div>
            <div class="relative p-1">
                <div class="relative">
                    <img
                        class="w-10 sm:w-16 h-10 sm:h-16 rounded-full"
                        :src="second_contact.profile"
                        v-if="second_contact.profile"
                    />
                    <i
                        v-else
                        class="bi bi-person-circle w-10 sm:w-16 h-10 sm:h-16 rounded-full text-gray-600"
                        style="font-size: 39px"
                    ></i>
                    <template v-if="second_contact.is_online">
                        <div
                            class="absolute button-0 right-0 -mr-0 -mt-4 w-4 h-4 rounded-full bg-green-400 animate-ping"
                        ></div>
                        <div
                            class="absolute button-0 right-0 -mr-0 -mt-4 w-4 h-4 rounded-full bg-green-400"
                        ></div>
                    </template>
                </div>
            </div>
            <div class="flex flex-col leading-tight">
                <div class="text-xl mt-1 flex items-center">
                    <span class="text-gray-100 mr-3 break-words"
                        >{{ second_contact.username }}
                    </span>
                </div>
                <span
                    v-if="second_contact.is_online"
                    class="text-sm text-gray-100"
                    >online
                </span>
                <span
                    v-if="second_contact.is_typing"
                    class="text-sm text-gray-100"
                    >typing...
                </span>
            </div>
            <!-- <div class="absolute right-3 ">
                <button >

                </button>
                <div class=" absolute z-50 px-0  rounded-md shadow-lg  right-4 bg-gray-500 p-2"
                    style="height: 190px;width: 200px;">
                    <button
                        class=" mx-auto py-2 text-lg  text-gray-800 w-full hover:bg-gray-600 hover:text-gray-300 block transition ">
                        Contact info

                    </button>
                    <button
                        class=" mx-auto py-2 text-lg  text-gray-800 w-full hover:bg-gray-600 hover:text-gray-300 block transition ">
                        Mute Conversation

                    </button>
                    <button
                        class=" mx-auto py-2 text-lg  text-gray-800 w-full hover:bg-gray-600 hover:text-gray-300 block transition ">
                        Delete Conversation

                    </button>
                    <button
                        class=" mx-auto py-2 text-lg  text-gray-800 w-full hover:bg-gray-600 hover:text-gray-300 block transition ">
                        Clear History

                    </button>
                </div>
            </div>  -->

            <Dropdown align="right" width="48">
                <template #trigger>
                    <i
                        class="bi bi-three-dots-vertical text-gray-200"
                        style="font-size: 20px"
                    ></i>
                </template>

                <template #content>
                    <!-- Account Management -->
                    <!-- <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Manage Account
                                </div> -->

                    <button
                        class="mx-auto py-2 text-lg text-gray-800 w-full hover:bg-gray-600 hover:text-gray-300 block transition"
                    >
                        Mute Conversation
                    </button>
                    <button
                        class="mx-auto py-2 text-lg text-gray-800 w-full hover:bg-gray-600 hover:text-gray-300 block transition"
                    >
                        Mute Conversation
                    </button>
                    <button
                        class="mx-auto py-2 text-lg text-gray-800 w-full hover:bg-gray-600 hover:text-gray-300 block transition"
                    >
                        Mute Conversation
                    </button>
                    <button
                        class="mx-auto py-2 text-lg text-gray-800 w-full hover:bg-gray-600 hover:text-gray-300 block transition"
                    >
                        Mute Conversation
                    </button>
                </template>
            </Dropdown>
        </div>
    </div>
</template>
