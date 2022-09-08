


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
    <div class="pb-2 relative flex px-2 justify-between">


        <AddContactForm v-if="show" v-on:modalClosed="toggleModal()" />

        <!-- Settings Dropdown -->
        <div class="relative">
            <Dropdown align="left" width="48">
                <template #trigger>
                    <button v-if="$page.props.jetstream.managesProfilePhotos"
                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                        <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url"
                            :alt="$page.props.contact.username" />
                    </button>

                    <span v-else class="inline-flex rounded-md">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-gray-200 hover:text-gray-700 focus:outline-none transition">
                            {{ $page.props.contact.username }}

                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
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
                            <i class="bi bi-person-circle" style="font-size: 22px"></i>
                        </div>
                    </DropdownLink>



                    <!-- <div class="border-t border-gray-100" /> -->

                    <!-- Authentication -->
                    <form @submit="logout">
                        <DropdownLink>
                            <div class="flex justify-between">
                                Logout
                                <i class="text-red-600 bi bi-box-arrow-right" style="font-size: 22px"></i>
                            </div>
                        </DropdownLink>
                    </form>
                </template>
            </Dropdown>
        </div>
        <button @click="toggleModal()"
            class="  px-4 py-2  text-gray-400  hover:text-gray-300 ">
            <i style="font-size: 28px" class="bi bi-person-plus-fill"></i>
        </button>
    </div>
</template>


