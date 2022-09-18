


<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import ExploreAccounts from "./ExploreAccounts.vue";
import NewBroadCast from "./NewBroadCast.vue";
import Navbar from "./Navbar.vue";
import ContactBio from "./ContactBio.vue";
import ChatList from "./ChatList.vue";

let logout = () => {
    Inertia.post(route("logout"));
};

// let showExploreAccounts = ref(false);

// let showBroadCast = ref(false);
let currentSidebar = ref('ChatList');

</script>
                

<template>
    <div style="width:65px ;" class="bg-gray-700 flex flex-col align-center items-center justify-start p-1">



        <img @click="currentSidebar = 'ContactBio'" class="h-12 w-12 rounded-full object-cover" :src="$page.props.user.profile"
            :alt="$page.props.user.username" />



        <button @click="currentSidebar = 'ExploreAccounts'"
            class="px-4 py-2 text-gray-400 mt-3 hover:text-gray-300">
            <i style="font-size: 28px" class="bi bi-search"></i>
        </button>

        <button @click="currentSidebar = 'BroadCast'" class="px-4 py-2 text-gray-400 hover:text-gray-300">
            <i class="bi bi-broadcast-pin"></i>
        </button>

        <button @click="currentSidebar = 'ChatList'" class="px-4 py-2 text-gray-400 hover:text-gray-300">
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
        class="  bg-gradient-to-r from-gray-800 overflow-x-auto to-gray-600 p-2 my-0 flex-col align-center h-screen"
        style="width: 420px;">



        <ContactBio v-if="currentSidebar == 'ContactBio'"/>
        <ChatList v-if="currentSidebar == 'ChatList'"/>
        <NewBroadCast v-if="currentSidebar == 'BroadCast'"/>
        <ExploreAccounts v-if="currentSidebar == 'ExploreAccounts'"/>
    </div>
</template>