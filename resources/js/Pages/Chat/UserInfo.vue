<template>
    <div
        class="pb-3 justify-around relative flex flex-col items-center space-x-4"
    >
        <!-- <div class="flex leading-tight">
                        <i
                            class="text-slate-50 bi bi-person-lines-fill"
                            style="font-size: 25px"
                        ></i>
                    </div> -->
        <!-- Settings Dropdown -->
        <div class="ml-3 relative">
            <Dropdown align="right" width="48">
                <template #trigger>
                    <button
                        v-if="$page.props.jetstream.managesProfilePhotos"
                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                    >
                        <img
                            class="h-10 w-10 rounded-full object-cover"
                            :src="$page.props.user.profile_photo_url"
                            :alt="$page.props.user.name"
                        />
                    </button>

                    <span v-else class="inline-flex rounded-md">
                        <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-gray-200 hover:text-gray-700 focus:outline-none transition"
                        >
                            {{ $page.props.user.name }}

                            <svg
                                class="ml-2 -mr-0.5 h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </span>
                </template>

                <template #content>
                    <!-- Account Management -->
                    <!-- <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Manage Account
                                </div> -->

                    <DropdownLink :href="route('profile.show')">
                        <div class="flex justify-around">
                            Profile
                            <i
                                class="bi bi-person-circle"
                                style="font-size: 22px"
                            ></i>
                        </div>
                    </DropdownLink>

                    <DropdownLink
                        v-if="$page.props.jetstream.hasApiFeatures"
                        :href="route('api-tokens.index')"
                    >
                        API Tokens
                    </DropdownLink>

                    <div class="border-t border-gray-100" />

                    <!-- Authentication -->
                    <form @submit="logout">
                        <DropdownLink as="button">
                            <div class="flex justify-around">
                                Logout
                                <i
                                    class="text-red-600 bi bi-box-arrow-right"
                                    style="font-size: 22px"
                                ></i>
                            </div>
                        </DropdownLink>
                    </form>
                </template>
            </Dropdown>
        </div>
        <span class="text-gray-100 text-xs">
            {{ $page.props.user.name }}
        </span>
    </div>
</template>

<script>

import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

export default {
    components: {
    Dropdown,
    DropdownLink,
    
},

};
</script>
