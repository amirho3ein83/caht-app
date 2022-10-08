<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";

let showForm = ref(false)

onMounted(()=>{
    setTimeout(() => {
    showForm.value = true
}, 60);
})
</script>
<template>
    <Transition name="slide-fade">

    <div
    v-if="showForm"
        style="left: 100px; top: 110px"
        class="w-2/4 max-w-xl p-8 absolute m-5 backdrop-blur-sm bg-white/20"
    >
        <h1
            class="title-font sm:text-4xl text-c-green text-3xl mb-4 font-medium"
        >
            Seekingon <br class="hidden lg:inline-block" />
        </h1>
        <h2
            class="title-font sm:text-4xl text-c-blue text-3xl mb-4 font-medium"
        >
            let's start chating man!
        </h2>
        <p class="mb-8 leading-relaxed text-gray-100">
            here ypu can find many friends to chat with. Lorem ipsum dolor sit
            amet consectetur adipisicing elit. Quas, ad enim minima accusantium
            quae voluptatem sapiente earum beatae fugiat odit dolores illum quos
            harum asperiores similique eos ratione
        </p>
        <div class="flex justify-center">
            <Link
                :href="route('register')"
                class="text-lg text-gray-300 hover:text-gray-100"
            >
                <button
                    class="inline-flex text-gray-900 bg-c-orange border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded text-lg"
                >
                    Register
                </button>
            </Link>
            <Link
                :href="route('login')"
                class="mx-2 text-lg text-gray-300 hover:text-gray-100"
            >
                <button
                    class="inline-flex text-gray-900 bg-c-orange border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded text-lg"
                >
                    Login
                </button>
            </Link>
        </div>
    </div>
</Transition>

    <img
        class="object-cover w-full h-screen"
        src="https://free4kwallpapers.com/uploads/originals/2022/01/20/astronaut-digital-art-wallpaper.jpg"
        alt=""
    />
</template>

