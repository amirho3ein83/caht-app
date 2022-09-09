<script setup></script>

<template>
    <div
        class="z-20 bg-gradient-to-b from-gray-700 to-gray-600 p-1 w-60 my-0 flex-col align-center h-screen"
        style="width: 420px"
    >
        <div class="flex flex-wrap items-center justify-center">
            <div
                class="container max-w-lg bg-white rounded dark:bg-gray-800 shadow-lg transform duration-200 easy-in-out m-5"
            >
                <i
                    @click="$emit('closeBioPage')"
                    class="absolute bi bi-arrow-left-circle-fill text-gray-700 ml-2 hover:text-gray-900"
                    style="font-size: 31px"
                ></i>

                <div class="h-2/4 sm:h-64 overflow-hidden">
                    <img
                        class="w-full rounded-t"
                        :src="$page.props.contact.profile"
                        :alt="$page.props.contact.username"
                    />
                </div>
                <div class="flex justify-start px-5 -mt-12 mb-5">
                    <span clspanss="block relative h-32 w-32">
                        <img
                            :src="$page.props.contact.profile"
                            :alt="$page.props.contact.username"
                            class="mx-auto object-cover rounded-full h-24 w-24 bg-white p-1"
                        />
                    </span>
                </div>
                <div class="">
                    <div class="px-7 mb-8">
                        <div class="flex justify-between">
                            <h2
                                class="text-3xl font-bold text-green-800 dark:text-gray-300"
                            >
                                {{ $page.props.contact.username }}
                            </h2>
                            <!-- <i class="bi bi-check2"></i> -->
                            <i
                                class="bi bi-pen-fill text-gray-400 text-lg hover:text-gray-500 hover:scale-110 duration-200"
                            ></i>
                        </div>
                        <p class="text-gray-400 mt-2 dark:text-gray-400">
                            about
                        </p>
                        <div class="flex justify-between">
                            <p
                                class="text-gray-400 text-lg mt-2 dark:text-gray-300"
                            >
                                this too shall pass
                            </p>
                            <!-- <i class="bi bi-check2"></i> -->
                            <i
                                class="bi bi-pen-fill text-gray-400 text-lg hover:text-gray-500 hover:scale-110 duration-200"
                            ></i>
                        </div>
                        <div
                            class="justify-center px-4 py-2 cursor-pointer bg-green-900 max-w-min mx-auto mt-8 rounded-lg text-gray-300 hover:bg-green-800 hover:text-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-gray-200"
                        >
                            {{ $page.props.user.email }}
                        </div>
                        <div
                            class="flex flex-wrap justify-center gap-2 sm:gap-4 mt-8"
                        >
                            <button
                                class="text-green-900 hover:text-green-700 p-1 sm:p-2 inline-flex items-center dark:text-gray-400 dark:hover:text-gray-300"
                            >
                                <i class="bi bi-twitter"></i>
                            </button>
                            <button
                                class="text-green-900 hover:text-green-700 p-1 sm:p-2 inline-flex items-center dark:text-gray-400 dark:hover:text-gray-300"
                            >
                                <i class="bi bi-github"></i>
                            </button>
                            <button
                                class="text-green-900 hover:text-green-700 p-1 sm:p-2 inline-flex items-center dark:text-gray-400 dark:hover:text-gray-30 dark:text-gray-400 dark:hover:text-gray-300"
                            >
                                <i class="bi bi-telegram"></i>
                            </button>
                            <button
                                class="text-green-900 hover:text-green-700 p-1 sm:p-2 inline-flex items-center dark:text-gray-400 dark:hover:text-gray-30 dark:text-gray-400 dark:hover:text-gray-300"
                            >
                                <i class="bi bi-instagram"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
