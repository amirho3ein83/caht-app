<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { onMounted, ref, toRef } from "vue";



let socialMedia = ref([]);


const getSocialMedia = () => {
    axios
        .get(route("user.socialMedia"))
        .then((response) => {
            console.log(response.data);
            socialMedia.value = response.data;

        })
        .catch((error) => {
            console.log(error);
        });
};
onMounted(() => {
    getSocialMedia();

})
</script>

<template>

    <div
        class="h-full container max-w-lg bg-gray-600 rounded dark:bg-gray-800 shadow-lg transform duration-200 easy-in-out ">


        <div class="h-2/4  overflow-hidden">
            <img class="w-full rounded-t" :src="$page.props.user.profile" :alt="$page.props.user.username" />
        </div>


        <div class="mt-4 flex-1">
            <div class="px-7 my-8 gap-2">

                    <div class="flex items-center border-b text-c-green">
                        <input
                            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                            type="text" :placeholder="$page.props.user.username " aria-label="Full name">
                        <button
                            class="flex-shrintext-c-green hover:scale-110 transition text-c-green text-white py-1 px-2 rounded"
                            type="button">
                            <i class="bi bi-check-lg"></i> </button>
                    </div>
                    <div class="mt-5 flex items-center border-b text-c-green">
                        <input
                            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                            type="text" placeholder="this too shall pass" aria-label="Full name">
                        <button
                            class="flex-shrintext-c-green hover:scale-110 transition text-c-green text-white py-1 px-2 rounded"
                            type="button">
                            <i class="bi bi-check-lg"></i> </button>
                    </div>

                <div
                    class="justify-center px-4 py-2 cursor-pointer bg-gray-900 max-w-min mx-auto mt-8 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-gray-200">
                    {{ $page.props.user.email }}
                </div>
                <div class="flex flex-wrap justify-center gap-2 sm:gap-4 mt-8">

                    <button
                        class="text-gray-900 hover:text-gray-700 p-1 sm:p-2 inline-flex items-center dark:hover:text-gray-30 dark:text-gray-600 dark:hover:text-gray-300">
                        <i class="bi bi-telegram"></i>
                        <p class="text-c-orange p-2">{{ socialMedia.telegram }}</p>


                    </button>
                    <button
                        class="text-gray-900 hover:text-gray-700 p-1 sm:p-2 inline-flex items-center dark:hover:text-gray-30 dark:text-gray-600 dark:hover:text-gray-300">
                        <i class="bi bi-instagram"></i>
                        <p class="text-c-orange p-2">{{ socialMedia.instagram }}</p>



                    </button>
                </div>
            </div>
        </div>
    </div>

</template>
