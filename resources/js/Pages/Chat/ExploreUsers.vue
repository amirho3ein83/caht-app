<script setup>
import axios from "axios";
import { computed, onMounted, ref, watch } from "vue";
import { managePageStore } from "@/stores/ManagePages";
import { Inertia } from "@inertiajs/inertia";
import Pagination from "@/Components/Pagination.vue";
import debounce from "lodash/debounce";
import UserItem from "../../Components/UserItem.vue";

const storePages = managePageStore();

let props = defineProps({
    users: Object,
});
let showItem = ref(false);

let search = ref("");
let categories = ref([]);

// let check = (el) => {
//     document.getElementById(el).checked = true;
//     // document.getElementById('deleteFilter').style.visibility = false;
// };

// let uncheck = (el) => {
//     document.getElementById(el).checked = false;
// };

watch(
    search,
    debounce(function (value) {
        Inertia.get(
            "/explore-users?search=" + value,
            { categories: categories.value },
            {
                replace: true,
                preserveState: true,
                onSuccess: (res) => {
                    props.users = res.data;
                },
            }
        );
    }, 300)
);

watch(categories, (value) => {
    console.log(value);
    Inertia.get(
        "/explore-users?search=" + search.value,
        { categories: value },
        {
            replace: true,
            preserveState: true,
            onSuccess: (res) => {
                props.users = res.data;
            },
        }
    );
});

onMounted(() => {
    storePages.currentSidebar = "ExploreUsers";
    setTimeout(() => {
        showItem.value = true;
    }, 1);
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,
};
</script>
<template>
    <div
        class="main h-full flex flex-col overflow-y-auto overflow-x-hidden w-full"
    >
        <div>
            <div class="relative bg-slate-600 mb-3">
                <div
                    class="flex absolute inset-y-0 right-2 items-center pl-3 pointer-events-none"
                >
                    <svg
                        aria-hidden="true"
                        class="w-7 h-7 text-gray-500 dark:text-gray-400"
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
                    class="block p-3 rounded-lg pl-10 w-full text-lg text-gray-900 bg-gray-100 outline-none"
                    placeholder="Search users"
                    required
                />
            </div>
            <div class="flex justify-center gap-3">
                <a
                    class="group cursor-pointer relative inline-flex items-center overflow-hidden rounded bg-fuchsia-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-fuchsia-500"
                >
                    <span
                        class="absolute left-0 -translate-x-full transition-transform group-hover:translate-x-4"
                    >
                        <i class="text-lg bi bi-x-lg"></i>
                    </span>

                    <span
                        class="text-lg font-medium transition-all group-hover:ml-4"
                    >
                        Followers
                    </span>
                </a>

                <a
                    class="rounded bg-gray-500 px-8 py-3 text-gray-300 cursor-pointer duration-200 ease-in-out hover:text-gray-700 hover:bg-gray-400 active:bg-fuchsia-500"
                >
                    <span class="text-lg font-medium">Followings </span>
                </a>
            </div>
        </div>
        <div class="h-full mt-4" v-if="users.data != []">
            <div
                class="my-1 space-y-1 h-full flex flex-col w-full flex-1 flex-end"
            >
                <UserItem
                    v-for="user in users.data"
                    :key="user.id"
                    :user="user"
                    :buttonType="`follow`"
                />
            </div>
        </div>
        <div
        v-show="users.data != undefined && users.data != {}"
        >
        <Pagination
            :nextPage="users.next_page_url"
            :previousPage="users.prev_page_url"
            :currentPage="users.current_page"
        />
        </div>
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
