<script setup></script>

<template>

            <div
                class="h-full container max-w-lg bg-gray-600 rounded dark:bg-gray-800 shadow-lg transform duration-200 easy-in-out "
            >


                <div class="h-2/4 sm:h-64 overflow-hidden">
                    <img
                        class="w-full rounded-t"
                        :src="$page.props.user.profile"
                        :alt="$page.props.user.username"
                    />
                </div>
                <div class="flex justify-start px-5 -mt-12 mb-5">
                    <span clspanss="block relative h-32 w-32">
                        <img
                            :src="$page.props.user.profile"
                            :alt="$page.props.user.username"
                            class="mx-auto object-cover rounded-full h-24 w-24 bg-white p-1"
                        />
                    </span>
                </div>
                <div class="">
                    <div class="px-7 mb-8">
                        <div class="flex justify-between">
                            <h2
                                class="text-3xl font-bold text-gray-800 dark:text-gray-300"
                            >
                                {{ $page.props.user.username }}
                            </h2>
                            <!-- <i class="bi bi-check2"></i> -->
                            <i
                                class="bi bi-pen-fill text-gray-300 text-lg hover:text-gray-600 hover:scale-110 duration-200"
                            ></i>
                        </div>
                        <p class="text-gray-600 mt-2 dark:text-gray-600">
                            about
                        </p>
                        <div class="flex justify-between">
                            <p
                                class="text-gray-600 text-lg mt-2 dark:text-gray-300"
                            >
                                this too shall pass
                            </p>
                            <!-- <i class="bi bi-check2"></i> -->
                            <i
                                class="bi bi-pen-fill text-gray-300 text-lg hover:text-gray-600 hover:scale-110 duration-200"
                            ></i>
                        </div>
                        <div
                            class="justify-center px-4 py-2 cursor-pointer bg-gray-900 max-w-min mx-auto mt-8 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-gray-200"
                        >
                            {{ $page.props.user.email }}
                        </div>
                        <div
                            class="flex flex-wrap justify-center gap-2 sm:gap-4 mt-8"
                        >
                            <button
                                class="text-gray-900 hover:text-gray-700 p-1 sm:p-2 inline-flex items-center dark:text-gray-600 dark:hover:text-gray-300"
                            >
                                <i class="bi bi-twitter"></i>
                            </button>
                            <button
                                class="text-gray-900 hover:text-gray-700 p-1 sm:p-2 inline-flex items-center dark:text-gray-600 dark:hover:text-gray-300"
                            >
                                <i class="bi bi-github"></i>
                            </button>
                            <button
                                class="text-gray-900 hover:text-gray-700 p-1 sm:p-2 inline-flex items-center dark:hover:text-gray-30 dark:text-gray-600 dark:hover:text-gray-300"
                            >
                                <i class="bi bi-telegram"></i>
                            </button>
                            <button
                                class="text-gray-900 hover:text-gray-700 p-1 sm:p-2 inline-flex items-center dark:hover:text-gray-30 dark:text-gray-600 dark:hover:text-gray-300"
                            >
                                <i class="bi bi-instagram"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

</template>
