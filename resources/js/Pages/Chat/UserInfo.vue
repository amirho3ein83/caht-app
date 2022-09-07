


<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { ref } from "vue";
import AddContactForm from "./AddContactForm.vue";
    
    let logout = () => {
        axios.post(route("logout"));
    };
    
    let show = ref(false);
    

    const toggleModal = () => {
        show.value = !show.value;
    }
    
    </script>
            

<template>
    <div class="pb-3 relative flex flex-col items-center space-x-4">
        <AddContactForm v-if="show"  v-on:modalClosed="toggleModal()" />

        <!-- Settings Dropdown -->
        <div class="relative">
            <Dropdown align="right" width="48">
                <template #trigger>
                    <button
                        v-if="$page.props.jetstream.managesProfilePhotos"
                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                    >
                        <img
                            class="h-15 w-15 rounded-full object-cover"
                            :src="$page.props.user.profile_photo_url"
                            :alt="$page.props.contact.username"
                        />
                    </button>

                    <span v-else class="inline-flex rounded-md">
                        <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-gray-200 hover:text-gray-700 focus:outline-none transition"
                        >
                            {{ $page.props.contact.username }}

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
                        <div class="flex justify-between">
                            Profile
                            <i
                                class="bi bi-person-circle"
                                style="font-size: 22px"
                            ></i>
                        </div>
                    </DropdownLink>

                    <button
                        @click="toggleModal()"
                        class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"
                    >
                        <div class="flex justify-between">
                            Add Contact
                            <i
                                style="font-size: 22px"
                                class="bi bi-person-plus-fill"
                            ></i>
                        </div>
                    </button>

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
                            <div class="flex justify-between">
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
        <p class="text-gray-100 text-sm mx-auto">
            {{ $page.props.contact.username }}
        </p>
    </div>
</template>


