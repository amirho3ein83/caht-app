<script setup>
import axios from "axios";
import { computed, onMounted, ref, watch } from "vue";
import { managePageStore } from "@/stores/ManagePages";
import { Inertia } from "@inertiajs/inertia";
import Pagination from "../../Components/Pagination.vue";
import debounce from 'lodash/debounce'
const storePages = managePageStore();

let props = defineProps({
    users: Object,
    filters: Object,
});

let search = ref(props.filters.search);

watch(search, debounce(function (value)  {
    console.log(';');
    Inertia.get(
        "/explore-users?search=" + value,
        {},
        {
            replace: true,
            preserveState: true,
            onSuccess: (res) => {
                props.users = res.data;
            },
        }
    );
},300));

const follow = (username) => {
    Inertia.get("/follow/" + username);
};

onMounted(() => {
    // props.users.data  = storePages.users
    storePages.currentSidebar = "ExploreUsers";
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
 
export default {
  layout: AppLayout
}
</script>
<template>
    <div
        class="m-4 w-[420px] h-[800px] flex flex-col overflow-y-hidden overflow-x-hidden"
    >
        <div>
            <div class="relative bg-slate-600 mb-3">
                <div
                    class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
                >
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5 text-gray-500 dark:text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        ></path>
                    </svg>
                </div>
                <input
                    v-model="search"
                    class="block p-3 rounded pl-10 w-full text-sm text-gray-900 bg-gray-100 outline-none"
                    placeholder="Search users"
                    required
                />
            </div>
            <div class="flex justify-center gap-3">
                <a
                    class="group relative inline-block overflow-hidden bg-gray-200 px-8 py-3 focus:outline-none focus:ring"
                    href="/download"
                >
                    <span
                        class="absolute inset-y-0 left-0 w-[2px] bg-fuchsia-500 transition-all group-hover:w-full group-active:bg-fuchsia-600"
                    ></span>

                    <span
                        class="relative text-sm font-bold text-gray-900 transition-colors group-hover:text-white"
                    >
                        Followers
                    </span>
                </a>

                <a
                    class="group relative inline-block overflow-hidden bg-gray-200  px-8 py-3 focus:outline-none focus:ring"
                    href="/download"
                >
                    <span
                        class="absolute inset-y-0 right-0 w-[2px] bg-fuchsia-500 transition-all group-hover:w-full group-active:bg-fuchsia-600"
                    ></span>

                    <span
                        class="relative text-sm font-bold text-gray-900 transition-colors group-hover:text-white"
                    >
                        Followings
                    </span>
                </a>
            </div>
        </div>
        <Transition name="fade" mode="out-in">
            <div class="h-full mt-4">
                <Transition name="slide-fade">
                    <div
                        class="my-1 space-y-1 h-full flex flex-col w-full flex-1 flex-end"
                    >
                        <div
                            v-for="user in users.data"
                            :key="user.id"
                            class="flex justify-start w-80 mx-auto text-gray-700 bg-gray-200 rounded-md p-1 hover:opacity-100 opacity-90 cursor-pointer hover:bg-slate-200"
                        >
                            <img
                                class="h-12 w-12 rounded-full object-cover"
                                :src="user.profile"
                                v-if="user.profile"
                            />

                            <p
                                class="flex-1 ml-3 text-center text-lg align-middle self-center"
                            >
                                {{ user.username }}
                            </p>
                            <button
                                @click="follow(user.username)"
                                class="text-sm font-normal px-4 hover:bg-indigo-600 bg-indigo-500 rounded text-gray-100 tracking-wide cursor-pointer hover:text-gray-50 transition hover:scale-105"
                            >
                                Follow
                            </button>
                        </div>
                    </div>
                </Transition>
            </div>
        </Transition>
        <Pagination
            :nextPage="users.next_page_url"
            :previousPage="users.prev_page_url"
            :currentPage="users.current_page"
        />
    </div>
</template>
<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
