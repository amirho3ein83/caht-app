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
import { Connection } from "@/stores/Connection";
import Settings from "./Settings.vue";
import Notifications from "./Notifications.vue";

const store = Connection();
let currentSidebar = ref("ChatList");
// let logout = () => {
//     Inertia.post(route("logout"));
// };
// let showExploreAccounts = ref(false);

// let showBroadCast = ref(false);
</script>

<template>
    <div
        class="text-center w-[65px] bg-gray-900 flex flex-col align-center items-center justify-between p-1"
    >
        <div>
            <img
                @click="currentSidebar = 'ContactBio'"
                class="object-cover h-16 w-16 rounded-full object-cover"
                :src="$page.props.user.profile"
                :alt="$page.props.user.username"
            />

            <button
                @click="currentSidebar = 'ChatList'"
                :class="{
                    'text-c-orange rounded-xl': currentSidebar == 'ChatList',
                }"
                class="bg-gray-600 rounded-3xl hover:rounded-xl transition-all duration-100 ease-linear py-2 px-3 text-gray-400 mt-3 hover:text-yellow-500"
            >
                <i class="bi bi-chat-left-dots"></i>
            </button>
            <button
                @click="currentSidebar = 'Notifications'"
                :class="{
                    'text-c-orange rounded-xl':
                        currentSidebar == 'Notifications',
                }"
                class="bg-gray-600 rounded-3xl hover:rounded-xl transition-all duration-100 ease-linear py-2 px-3 text-gray-400 mt-3 hover:text-yellow-500"
            >
                <i class="bi bi-bell"></i>
            </button>
            <button
                @click="currentSidebar = 'ExploreAccounts'"
                class="bg-gray-600 rounded-3xl hover:rounded-xl transition-all duration-100 ease-linear py-2 px-3 text-gray-400 mt-3 hover:text-yellow-500"
                :class="{
                    'text-c-orange rounded-xl':
                        currentSidebar == 'ExploreAccounts',
                }"
            >
                <i style="font-size: 28px" class="bi bi-search"></i>
            </button>

            <button
                @click="currentSidebar = 'BroadCast'"
                :class="{
                    'text-c-orange rounded-xl': currentSidebar == 'BroadCast',
                }"
                class="bg-gray-600 rounded-3xl hover:rounded-xl transition-all duration-100 ease-linear py-2 px-3 text-gray-400 mt-3 hover:text-yellow-500"
            >
                <i class="bi bi-broadcast-pin"></i>
            </button>
        </div>

        <div>
            <button
                @click="store.logout"
                class="px-4 py-2 text-gray-400 hover:text-yellow-500 transition"
            >
                <i
                    class="text-red-600 bi bi-box-arrow-right"
                    style="font-size: 28px"
                ></i>
            </button>

            <button
                @click="currentSidebar = 'Settings'"
                class="px-4 py-2 hover:animate-spin"
            >
                <i
                    class="text-slate-400 bi bi-gear-wide hover:text-yellow-500"
                    style="font-size: 28px"
                ></i>
            </button>
        </div>
    </div>

    <!-- chat list page -->
    <div
        class="w-[420px] bg-gradient-to-r from-gray-800 overflow-x-hidden to-gray-600 p-2 my-0 flex-col align-center h-screen"
    >
        <ContactBio v-if="currentSidebar == 'ContactBio'" />
        <Notifications v-if="currentSidebar == 'Notifications'" />
        <Settings v-if="currentSidebar == 'Settings'" />
        <ChatList v-if="currentSidebar == 'ChatList'" />
        <NewBroadCast v-if="currentSidebar == 'BroadCast'" />
        <ExploreAccounts v-if="currentSidebar == 'ExploreAccounts'" />
    </div>
</template>
