


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
import { useGetChatsStore } from '@/stores/getChats'

const store = useGetChatsStore()
let currentSidebar = ref('ChatList');
// let logout = () => {
//     Inertia.post(route("logout"));
// };
// let showExploreAccounts = ref(false);

// let showBroadCast = ref(false);

</script>
                

<template>
    <div style="width:65px ;" class="bg-gray-700 flex flex-col align-center items-center justify-between p-1">



        <div>
            <img @click="currentSidebar = 'ContactBio'" class=" ml-2 h-12 w-12 rounded-full object-cover "
                :src="$page.props.user.profile" :alt="$page.props.user.username" />



            <button @click="currentSidebar = 'ExploreAccounts'"
                class="px-4 py-1 text-gray-400 mt-3 hover:text-yellow-500 transition"
                :class="{'text-c-orange':currentSidebar == 'ExploreAccounts'}">
                <i style="font-size: 28px" class="bi bi-search"></i>
            </button>

            <button @click="currentSidebar = 'BroadCast'" :class="{'text-c-orange':currentSidebar == 'BroadCast'}"
                class="px-4 py-1 text-gray-400 hover:text-yellow-500 transition">
                <i class="bi bi-broadcast-pin "></i>
            </button>

            <button @click="currentSidebar = 'ChatList'" :class="{'text-c-orange':currentSidebar == 'ChatList'}"
                class="px-4 pt-2 text-gray-400 hover:text-yellow-500 transition">
                <i class="bi bi-chat-left-dots"></i>
            </button>
        </div>

        <div>
            <button @click="store.logout" class="px-4 py-2  text-gray-400 hover:text-yellow-500 transition ">
                <i class="text-red-600 bi bi-box-arrow-right" style="font-size: 28px"></i>
            </button>

            <button @click="currentSidebar = 'Setting'" class="px-4 py-2  hover:animate-spin ">
                <i class="text-slate-400 bi bi-gear-wide hover:text-yellow-500 " style="font-size: 28px"></i>
            </button>

        </div>



    </div>



    <!-- chat list page -->
    <div class="  bg-gradient-to-r from-gray-800 overflow-x-auto to-gray-600 p-2 my-0 flex-col align-center h-screen"
        style="width: 420px;">



        <ContactBio v-if="currentSidebar == 'ContactBio'"/>
        <ChatList v-if="currentSidebar == 'ChatList'"/>
        <NewBroadCast v-if="currentSidebar == 'BroadCast'"/>
        <ExploreAccounts v-if="currentSidebar == 'ExploreAccounts'"/>
    </div>
</template>