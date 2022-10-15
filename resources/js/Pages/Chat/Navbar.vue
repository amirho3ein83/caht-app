<script setup>
import { Inertia } from "@inertiajs/inertia";
import { managePageStore } from "@/stores/ManagePages";
import NavItem from "../../Components/NavItem.vue";
import Logout from "./Logout.vue";
import { notificationStore } from "@/stores/Notifications";

const useNotificationStore = notificationStore();

const storePages = managePageStore();
</script>

<template>
    <div
        class="sticky left-0 z-50 h-screen text-center w-[65px] bg-gray-900 flex flex-col align-center items-center justify-between p-1"
    >
        <div>
            <img
                @click="storePages.setPage('ContactBio')"
                class="object-cover h-16 w-16 rounded-full"
                :class="{
                    'border-4 border-green-400':
                        storePages.currentSidebar == 'ContactBio',
                }"
                :src="$page.props.user.profile"
                :alt="$page.props.user.username"
            />

            <NavItem
                :disabled="storePages.currentSidebar == 'ChatList'"
                :page="`ChatList`"
                :icon="`bi bi-chat-left-dots`"
                :active="storePages.currentSidebar == 'ChatList'"
            />

            <NavItem
                :disabled="storePages.currentSidebar == 'Notifications'"
                :page="`Notifications`"
                :icon="`bi bi-bell`"
                :active="storePages.currentSidebar == 'Notifications'"
            >
                <div v-if="storePages.currentSidebar != 'Notifications'">
                    <span v-if="useNotificationStore.unreadNotifications != 0">
                        <div
                            class="absolute top-2 -right-2 w-6 h-6 p-0 m-0 rounded-full bg-red-500 text-white"
                        >
                            {{ useNotificationStore.unreadNotifications }}
                        </div>
                    </span>
                </div>
            </NavItem>

            <NavItem
                :disabled="storePages.currentSidebar == 'ExploreUsers'"
                :page="`ExploreUsers`"
                :icon="`bi bi-search`"
                :active="storePages.currentSidebar == 'ExploreUsers'"
            />
            <NavItem
                :disabled="storePages.currentSidebar == 'BroadCast'"
                :page="`BroadCast`"
                :icon="`bi bi-broadcast-pin`"
                :active="storePages.currentSidebar == 'BroadCast'"
            />
        </div>

        <div>
            <button
                @click="storePages.setPage('Settings')"
                :disabled="storePages.currentSidebar == 'Settings'"
                :class="{
                    'text-yellow-500 scale-105':
                        storePages.currentSidebar == 'Settings',
                }"
                class="hover:scale-105 duration-150 ease-out p-2 text-gray-400 mt-3 hover:text-yellow-500"
            >
                <i class="bi bi-gear"></i>
            </button>

            <Logout />
        </div>
    </div>
</template>

<style>
i {
    font-size: 30px;
}
</style>
