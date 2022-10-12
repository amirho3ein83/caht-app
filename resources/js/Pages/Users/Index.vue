<script setup>
import { Link, Component } from "@inertiajs/inertia-vue3";
import JetNavLink from "@/Components/NavLink.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Paginate from "vuejs-paginate-next";
import NavLink from "../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Components/NavLink.vue";
import { ref } from "@vue/reactivity";
import { watch } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";
import throttle from "lodash/throttle";

let props = defineProps({
    users: Object,
    filters: Object,
});

let search = ref(props.filters.search);

// watch(
//     search,
//     throttle(function (value) {
//         Inertia.get(
//             route("users.index"),
//             { search: value },
//             {
//                 preserveState: true,
//                 replace: true,
//             }
//         );
//     }, 300)
// );
</script>
<template>
    <AppLayout title="users">
        <div class="py-12 mx-3">
            <form>
                <div class="justify-end relative">
                    <input
                        type="search"
                        v-model="search"
                        id="default-search"
                        class="block p-4 pl-10 m-auto text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500"
                        placeholder="Search "
                        required
                    />
                    <!-- <button
                        type="submit"
                        class="text-white absolute right-2.5 bottom-2.5 bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                    >
                        Search
                    </button> -->
                </div>
            </form>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden rounded-lg">
                            <table class="min-w-full text-center">
                                <thead class="border-b bg-gray-800">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="text-sm font-medium text-white px-4 py-2"
                                        >
                                            name
                                        </th>
                                        <th
                                            scope="col"
                                            class="text-sm font-medium text-white px-4 py-2"
                                        >
                                            email
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="user in users.data"
                                        :key="user.id"
                                        class="bg-gradient-to-b from-gray-300 via-gray-400 to-gray-500border-b"
                                    >
                                        <td
                                            v-text="user.name"
                                            class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900"
                                        ></td>
                                        <td
                                            v-text="user.email"
                                            class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900"
                                        ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-auto text-center">
                <!-- <NavLink
                    :href="users.prev_page_url"
                    preserve-scroll
                    class="mr-3 inline-flex items-center py-1 px-3 text-sm font-medium text-gray-500 bg-gradient-to-b from-gray-300 via-gray-400 to-gray-500rounded-lg border border-gray-300 hover:bg-gray-300 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                >
                    Previous
                </NavLink>
                <span
                    class="inline-flex items-center py-1 px-3 text-sm font-medium text-gray-500 bg-gray-300 rounded-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                >
                    {{ users.current_page }}
                </span>

                <NavLink
                    :href="users.next_page_url"
                    preserve-scroll
                    class="inline-flex items-center py-1 px-3 ml-3 text-sm font-medium text-gray-500 bg-gradient-to-b from-gray-300 via-gray-400 to-gray-500rounded-lg border border-gray-300 hover:bg-gray-300 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                >
                    Next
                </NavLink> -->
                <template v-for="link in users.links" :key="link.url">
                    <JetNavLink
                        v-if="link.url"
                        :href="link.url"
                        v-html="link.label"
                        preserve-scroll
                        :class="{ 'bg-gray-100': link.active }"
                    />
                </template>
            </div>
        </div>
    </AppLayout>
</template>
