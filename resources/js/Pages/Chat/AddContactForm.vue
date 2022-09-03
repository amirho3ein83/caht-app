<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetInputError from "@/Components/InputError.vue";

// const form = useForm({
//     username: "",
// });

// const submit = () => {
//     form.post(route("addContact"), {
//         onFinish: () => console.log('done'),
//     });
// };
//
</script>

<template>
    <!-- Main modal -->
    <div
        id="crypto-modal"
        tabindex="-1"
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex"
        aria-modal="true"
        role="dialog"
    >
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button
                    type="button"
                    class="absolute -top-3 -right-2.5 text-white bg-transparent bg-red-400 hover:bg-red-500 hover:text-white rounded-full text-sm p-1.5 ml-auto inline-flex items-center hover:animate-spin dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-toggle="crypto-modal"
                    @click="$emit('modalClosed')"
                >
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <!-- Modal header -->
                <div class="py-4 px-6 rounded-t dark:border-gray-600">
                    <div class="relative">
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
                            id="default-search"
                            class="block p-3 rounded pl-10 w-full text-sm text-gray-900 bg-gray-100"
                            placeholder="Search Contacts"
                            required
                        />
                    </div>
                </div>
                <!-- Modal body -->
                <div class="p-4">
                    <hr />

                    <div class="my-2 space-y-3 flex flex-col mx-auto w-2/3">
                        <div v-for="index in [1, 2, 2, 3, 6, 5]">
                            <a
                                href="#"
                                class="flex items-center p-3 text-base text-gray-800 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white"
                            >
                                <i class="bi bi-person-plus-fill"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap"
                                    >username</span
                                >
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
