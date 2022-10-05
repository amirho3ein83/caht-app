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
            class="w-80 mx-auto h-2/4 object-cover rounded-t rounded-full"
            :src="$page.props.user.profile"
            :alt="$page.props.user.username"
        />
    </Transition>
    <div class="mt-4">
        <div class="px-7 my-8 gap-2">
                <h1
                class="appearance-none bg-transparent  w-full text-gray-400 text-3xl mr-3 py-1 px-2  "
                
                >{{$page.props.user.username}}</h1>
                <h4 class="resize-none  text-gray-400  appearance-none bg-transparent" cols="30" rows="2">{{socialMedia.bio}}</h4>
            <div class="mt-5 flex items-center border-b border-gray-600">
                <h2
                class="appearance-none bg-transparent  w-full text-gray-400 text-lg mr-3 py-1 px-2  "
                
                >{{$page.props.user.email}}</h2>
            </div>
            <div
                class="mt-5 flex items-center border-b border-gray-600 text-gray-300"
            >
                <i class="bi bi-telegram"></i>

                <h2
                class="appearance-none bg-transparent  w-full text-gray-400 text-lg mr-3 py-1 px-2  "
                
                >{{socialMedia.telegram}}</h2>
            </div>

            <div
                class="mt-5 flex items-center border-b border-gray-600 text-gray-300"
            >
                <i class="bi bi-instagram"></i>

                <h2
                class="appearance-none bg-transparent  w-full text-gray-400 text-lg mr-3 py-1 px-2  "
                
                >{{socialMedia.instagram}}</h2>
            </div>
        </div>
    </div>
</template>
