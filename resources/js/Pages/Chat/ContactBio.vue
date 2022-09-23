<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { onMounted, ref, toRef } from "vue";

let props = defineProps({
    user:Object
})
let socialMedia = ref([]);

let pageLoaded = ref(false);

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

const updateInfoForm = useForm({
    email:'',
    username: '',
    instagram: socialMedia.instagram,
    telegram: socialMedia.telegram,
    bio: socialMedia.bio
});

const updateInfo = () => {
    updateInfoForm.post(route("update.user.info"), {
        onFinish: () => form.reset("password"),
    });
};

onMounted(() => {
    getSocialMedia();
    pageLoaded.value = true;
});
</script>

<template>
    <Transition name="bounce">
        <img
            v-show="pageLoaded"
            class="w-full h-2/4 object-cover rounded-t rounded-full"
            :src="$page.props.user.profile"
            :alt="$page.props.user.username"
        />
    </Transition>
    <div class="mt-4">
        <div class="px-7 my-8 gap-2">
            <div class="flex justi items-center border-b border-gray-600">
                <input
                    class="appearance-none bg-transparent border-none w-full text-gray-400 text-2xl py-1 px-2"
                    type="text"
                    v-model="$page.props.user.username"
                    aria-label="Full name"
                />
            </div>
            <div class="mt-5 flex items-center border-b border-gray-600">
                <!-- <input
                    class="appearance-none bg-transparent border-none w-full text-gray-400 text-lg mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    v-model="socialMedia.bio"
                    aria-label="Full name"
                /> -->
                <textarea class="resize-none border-none appearance-none bg-transparent" v-model="socialMedia.bio" cols="30" rows="2"></textarea>
            </div>
            <div class="mt-5 flex items-center border-b border-gray-600">
                <input
                    class="appearance-none bg-transparent border-none w-full text-gray-400 text-lg mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="email"
                    v-model="$page.props.user.email"
                    aria-label="Full name"
                />
            </div>
{{ socialMedia.bio }}
            <div
                class="mt-5 flex items-center border-b border-gray-600 text-gray-300"
            >
                <i class="bi bi-telegram"></i>

                <input
                    class="appearance-none bg-transparent border-none w-full text-gray-400 text-lg mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    v-model="socialMedia.telegram"

                />
            </div>

            <div
                class="mt-5 flex items-center border-b border-gray-600 text-gray-300"
            >
                <i class="bi bi-instagram"></i>

                <input
                    class="appearance-none bg-transparent border-none w-full text-gray-400 text-lg mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    v-model="socialMedia.instagram"
                />
            </div>
            <div class="mx-auto p-3 m-4 text-center">
                <!-- <Transition> -->
                <i
                    v-show="pageLoaded"
                    class="bi bi-check-lg text-c-green hover:scale-125"
                    style="font-size: 58"
                ></i>
                <!-- </Transition> -->
            </div>
        </div>
    </div>
</template>
