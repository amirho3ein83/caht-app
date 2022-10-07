
<script setup>
import { managePageStore } from "@/stores/ManagePages";
import { Inertia } from "@inertiajs/inertia";

const storePages = managePageStore();

const logout =()=> {
            Inertia.post(route("logout"));
        }   
    </script>
    
    <template>
    <div
        class="text-center w-[65px] bg-gray-900 flex flex-col align-center items-center justify-between p-1"
    >
        <div>
            <img
                @click="storePages.setPage('ContactBio')"
                class="object-cover h-16 w-16 rounded-full"
                :src="$page.props.user.profile"
                :alt="$page.props.user.username"
            />

            <button
                @click="storePages.setPage('ChatList')"
                :class="{
                    'text-c-orange rounded-xl': storePages.currentSidebar == 'ChatList',
                }"
                class="bg-gray-600 rounded-3xl hover:rounded-xl transition-all duration-100 ease-linear py-2 px-3 text-gray-400 mt-3 hover:text-yellow-500"
            >
                <i class="bi bi-chat-left-dots"></i>
            </button>
            <button
                @click="storePages.setPage('Notifications')"
                :class="{
                    'text-c-orange rounded-xl':
                        storePages.currentSidebar == 'Notifications',
                }"
                class="bg-gray-600 rounded-3xl hover:rounded-xl transition-all duration-100 ease-linear py-2 px-3 text-gray-400 mt-3 hover:text-yellow-500"
            >
                <i class="bi bi-bell"></i>
            </button>
            <button
                @click="storePages.setPage('ExploreAccounts')"
                class="bg-gray-600 rounded-3xl hover:rounded-xl transition-all duration-100 ease-linear py-2 px-3 text-gray-400 mt-3 hover:text-yellow-500"
                :class="{
                    'text-c-orange rounded-xl':
                        storePages.currentSidebar == 'ExploreAccounts',
                }"
            >
                <i style="font-size: 28px" class="bi bi-search"></i>
            </button>

            <button
                @click="storePages.setPage('BroadCast')"
                :class="{
                    'text-c-orange rounded-xl': storePages.currentSidebar == 'BroadCast',
                }"
                class="bg-gray-600 rounded-3xl hover:rounded-xl transition-all duration-100 ease-linear py-2 px-3 text-gray-400 mt-3 hover:text-yellow-500"
            >
                <i class="bi bi-broadcast-pin"></i>
            </button>
        </div>

        <div>
            <button
                @click="logout()"
                class="px-4 py-2 text-gray-400 hover:text-yellow-500 transition"
            >
                <i
                    class="text-red-600 bi bi-box-arrow-right"
                    style="font-size: 28px"
                ></i>
            </button>

            <button
                @click="storePages.setPage('Settings') "
                class="px-4 py-2 hover:animate-spin"
            >
                <i
                    class="text-slate-400 bi bi-gear-wide hover:text-yellow-500"
                    style="font-size: 28px"
                ></i>
            </button>
        </div>
    </div>
    </template>
    