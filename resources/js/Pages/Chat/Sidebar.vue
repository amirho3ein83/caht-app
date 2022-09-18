


<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import ExploreAccounts from "./ExploreAccounts.vue";
import NewBroadCast from "./NewBroadCast.vue";


let logout = () => {
    Inertia.post(route("logout"));
};

let showExploreAccounts = ref(false);


let showBroadCastForm = ref(false);
const toggleBroadCastForm = () => {
    showBroadCastForm.value = !showBroadCastForm.value;
};
</script>
                

<template>
    <div style="width:65px ;" class="bg-gray-700 flex flex-col align-center items-center justify-start p-1">



        <img @click="$emit('closeBioPage')" class="h-12 w-12 rounded-full object-cover" :src="$page.props.user.profile"
            :alt="$page.props.user.username" />



        <button @click="showExploreAccounts = !showExploreAccounts"
            class="px-4 py-2 text-gray-400 mt-3 hover:text-gray-300">
            <i style="font-size: 28px" class="bi bi-search"></i>
        </button>

        <button @click="toggleBroadCastForm()" class="px-4 py-2 text-gray-400 hover:text-gray-300">
            <i class="bi bi-broadcast-pin"></i>
        </button>

        <button class="px-4 py-2 text-gray-400 hover:text-gray-300">
            <i class="bi bi-chat-left-dots"></i>
        </button>


        <!-- Authentication -->
        <form @submit.prevent="logout">
            <DropdownLink as="button" class="hover:bg-slate-400">
                <i class="text-red-600 bi bi-box-arrow-right" style="font-size: 22px"></i>

            </DropdownLink>
        </form>




    </div>

    <!-- chat list page -->
    <div 
        class=" block bg-gradient-to-r from-gray-800 overflow-x-auto to-gray-600 p-2 my-0 flex-col align-center h-screen"
        style="width: 420px;">

        <!-- <div class="m-4">
            <Navbar v-on:closeBioPage="toggleBioPage" />


            <div class="w-96 mx-auto relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input
                    class="block rounded-2xl p-1 mb-4 w-96 text-lg text-gray-900 h-10 bg-gray-300 outline-none focus:bg-gray-200"
                    placeholder="           Search Contacts" />
            </div>



            <div
                class=" flex flex-1 flex-end flex-col space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                <div id="messages"
                    class="flex flex-end h-100 flex-col-reverse space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                    <div>
                        <template v-for="chat in chats" :key="chat.id">
                            <ChatItem v-if="chat" :chat="chat" :currentChat="currentChat"
                                v-on:chatChanged="setChat($event)" v-on:following="
                                    setSecondContact($event)
                                " />
                        </template>
                        <p class="text-slate-300 font-medium text-center animate-pulse" v-if="noChat()">
                            let's start following others to chat with!
                        </p>
                    </div>
                </div>
            </div>
        </div> -->
        <NewBroadCast v-if="showBroadCastForm"/>
    </div>
</template>