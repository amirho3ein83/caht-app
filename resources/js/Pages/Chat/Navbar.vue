<script setup>
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import LogoutModal from "./Modals/LogoutModal.vue";
import { managePageStore } from "@/stores/ManagePages";
import NavItem from "../../Components/NavItem.vue";

const storePages = managePageStore();

let showLogoutModal = ref(false);
</script>

<template>
    <div
        class="text-center w-[65px] bg-gray-900 flex flex-col align-center items-center justify-between p-1"
    >
        <div>
            <img
                @click="storePages.setPage('ContactBio')"
                class="object-cover h-16 w-16 rounded-full"
                :class="{'border-4 border-green-400':storePages.currentSidebar == 'ContactBio'}"
                :src="$page.props.user.profile"
                :alt="$page.props.user.username"
            />


            <NavItem 
            :page="`ChatList`"
            :icon="`bi bi-chat-left-dots`"
            :active="storePages.currentSidebar == 'ChatList'"
            />

            <NavItem 
            :page="`Notifications`"
            :icon="`bi bi-bell`"
            :active="storePages.currentSidebar == 'Notifications'"

            />

            <NavItem 
            :page="`ExploreAccounts`"
            :icon="`bi bi-search`"
            :active="storePages.currentSidebar == 'ExploreAccounts'"
            />
            <NavItem 
            :page="`BroadCast`"
            :icon="`bi bi-broadcast-pin`"
            :active="storePages.currentSidebar == 'BroadCast'"
            />
        </div>

        <div>
            <button
                @click="storePages.setPage('Settings')"
                :class="{
                    'text-yellow-500 scale-105':
                        storePages.currentSidebar == 'Settings',
                }"
                class="hover:scale-105 duration-150 ease-out p-2 text-gray-400 mt-3 hover:text-yellow-500"
            >
                <i class="bi bi-gear"></i>
            </button>
            <button
                @click="showLogoutModal = true"
                class="hover:scale-105 duration-150 ease-out p-2 text-red-500 mt-3 hover:text-red-600"
            >
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </div>

        <LogoutModal
            v-on:close="showLogoutModal = false"
            v-show="showLogoutModal"
        />
    </div>
</template>
