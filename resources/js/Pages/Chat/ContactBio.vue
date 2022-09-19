<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { onMounted, ref, toRef } from "vue";

let socialMedia = ref([]);

let instagram = ref(socialMedia.instagram);

let editingInstagram = ref(false);
let editingTelegram = ref(false);
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
const updateInstagram = () => {
    console.log("instagram");
    Inertia.post(route("update.instagram"), { instagram: instagram });
};

const updateInfoForm = useForm({
    email: "l",
    username: "",
    instagram: instagram.value,
    telegram: socialMedia.value,
    bio: "",
});

const updateInfo = () => {
    updateInfoForm.post(route("update.user.info"), {
        onFinish: () => form.reset("password"),
    });
};

onMounted(() => {
    getSocialMedia();
    pageLoaded.value = true
});
</script>

<template>
    <div
        class="h-full container max-w-lg bg-gray-600 rounded dark:bg-gray-800 shadow-lg transform duration-200 easy-in-out"
    >

<Transition name="bounce" >
                            
            <img v-show="pageLoaded"
                class="w-full rounded-t rounded-full"
                :src="$page.props.user.profile"
                :alt="$page.props.user.username"
            />
</Transition>
        <div class="mt-4 flex-1">
            <div class="px-7 my-8 gap-2">
                <div class="flex justi items-center border-b border-gray-600">
                    <input
                        class="appearance-none bg-transparent border-none w-full text-gray-400 text-lg py-1 px-2"
                        type="text"
                        v-model="updateInfoForm.username"
                        aria-label="Full name"
                    />
                </div>
                <div class="mt-5 flex items-center border-b border-gray-600">
                    <input
                        class="appearance-none bg-transparent border-none w-full text-gray-400 text-lg mr-3 py-1 px-2 leading-tight focus:outline-none"
                        type="text"
                        v-model="updateInfoForm.bio"
                        aria-label="Full name"
                    />
                </div>
                <div class="mt-5 flex items-center border-b border-gray-600">
                    <input
                        class="appearance-none bg-transparent border-none w-full text-gray-400 text-lg mr-3 py-1 px-2 leading-tight focus:outline-none"
                        type="email"
                        v-model="updateInfoForm.email"
                        aria-label="Full name"
                    />
                </div>

                <div
                    class="mt-5 flex items-center border-b border-gray-600 text-gray-300"
                >
                    <i class="bi bi-telegram"></i>

                    <input
                        @focus="editingTelegram = true"
                        @blur="editingTelegram = false"
                        class="appearance-none bg-transparent border-none w-full text-gray-400 text-lg mr-3 py-1 px-2 leading-tight focus:outline-none"
                        type="text"
                        v-model="socialMedia.telegram"
                    />
                    <i
                        v-show="editingTelegram"
                        class="bi bi-check-lg text-c-green self-end"
                    ></i>
                </div>

                <div
                    class="mt-5 flex items-center border-b border-gray-600 text-gray-300"
                >
                    <i class="bi bi-instagram"></i>

                    <input
                        @focus="editingInstagram = true"
                        @blur="editingInstagram = false"
                        class="appearance-none bg-transparent border-none w-full text-gray-400 text-lg mr-3 py-1 px-2 leading-tight focus:outline-none"
                        type="text"
                        v-model="instagram"
                    />

                    <Transition>
                        <i
                            v-show="editingInstagram"
                            class="bi bi-check-lg text-c-green self-end"
                        ></i>
                    </Transition>
                </div>
            </div>
        </div>
    </div>
    
</template>
