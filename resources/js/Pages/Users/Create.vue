<script setup>
import { Link, Component, useForm } from "@inertiajs/inertia-vue3";
import JetNavLink from "@/Components/NavLink.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Paginate from "vuejs-paginate-next";
import NavLink from "../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Components/NavLink.vue";
import { ref } from "@vue/reactivity";
import { watch } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";

let props = defineProps({});

const form = useForm({
    name: "",
    email: "",
    password: "",
});

const createUser = () => {
    form.post(
        route("users.store", {
            errorBag: "createTeam",
            preserveScroll: true,
        })
    );
};
</script>
<template>
    <AppLayout title="users">
        <div class="w-full max-w-xs mx-auto my-6">
            <form
                class="bg-gradient-to-b from-gray-300 via-gray-400 to-gray-500shadow-md rounded-2xl px-8 pt-6 pb-8 mb-4"
                @submitted="createUser"
            >
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="name"
                    >
                        name
                    </label>
                    <input
                        class="rounded w-full py-2 px-3 text-gray-700 border-none"
                        id="name"
                        type="text"
                    />
                </div>
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="email"
                    >
                        email
                    </label>
                    <input
                        class="rounded w-full py-2 px-3 text-gray-700 border-none"
                        id="email"
                        type="email"
                    />
                </div>
                <div class="mb-6">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="password"
                    >
                        Password
                    </label>
                    <input
                        class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password"
                        type="password"
                    />
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="p-1 pl-5 pr-5 bg-transparent border-2 border-gray-500 text-gray-500 text-lg rounded-lg transition-colors duration-70 transform hover:bg-gray-500 hover:text-gray-100 focus:border-4 focus:border-gray-300"
                        type="button"
                    >
                        Sign In
                    </button>
                    <a
                        class="transition ease-in delay-25 hover:scale-105"
                        href="#"
                    >
                        Forgot Password?
                    </a>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
