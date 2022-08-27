<script setup>
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetButton from "@/Components/Button.vue";

import JetLabel from "@/Components/Label.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
</script>
<template>
    <div
        style="height: 610px"
        class="flex-col rounded-xl bg-gray-200 max-w-sm mx-auto h-30"
    >
        <h2
            class="text-center p-3 my-3 font-semibold text-2xl text-gray-800 leading-tight"
        >
            Let's talk
        </h2>
        <div class="justify-end relative">
            <input
                type="text"
                id="username_input"
                name="username"
                class="block p-4 pl-10 m-auto text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500"
                placeholder="message to... "
                required
            />
        </div>
        <div
            id="messages"
            class="w-auto mx-2 bg-slate-400 my-2 p-2 h-96 rounded-xl"
        >
            message box
        </div>
        <div class="w-auto mx-2 bg-slate-500 my-2 p-2 rounded-xl">
            <form id="message_form " >
                <div>
                    <JetInput
                        id="message_input"
                        name="message"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                    />
                </div>
                <JetButton class="mx-auto my-2" id="message_send">
                    Send
                </JetButton>
            </form>
        </div>
    </div>



</template>
