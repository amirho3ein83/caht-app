<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Components/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetLabel from "@/Components/Label.vue";

// defineProps({
//     canResetPassword: Boolean,
//     status: String,
// });

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <div class="flex">
        <img
            class="object-cover w-full h-screen"
            src="https://free4kwallpapers.com/uploads/originals/2022/01/20/astronaut-digital-art-wallpaper.jpg"
            alt=""
        />
        <div
            style="left: 100px; top: 110px"
            class="w-full max-w-xl p-8 absolute m-5 backdrop-blur-sm bg-white/20"
        >
            <form @submit.prevent="submit" >
                <h1 class="text-2xl font-bold mb-4">Sign in to your account</h1>

                <div>
                <JetLabel for="email" value="email" />
                <JetInput
                    id="email"
                    v-model="form.email"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
                <JetInputError class="mt-2" :message="form.errors.email" />
            </div>
    
            <div class="mt-4">
                <JetLabel for="password" value="Password" />
                <JetInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
                <JetInputError class="mt-2" :message="form.errors.password" />
            </div>
                <div class="mt-4 flex justify-between">
                    <label class="flex items-center">
                        <JetCheckbox
                            v-model:checked="form.remember"
                            class="w-6 h-6"
                            name="remember"
                        />
                        <span class="ml-2 text-lg text-gray-200"
                            >Remember me</span
                        >
                    </label>

                    <div class="flex flex-col mt-2">
                        <Link
                            :href="route('password.request')"
                            class="my-1  text-lg text-gray-300 hover:text-gray-100"
                        >
                            Forgot your password?
                        </Link>
                        <Link
                            :href="route('register')"
                            class="my-1 text-lg  text-gray-300 hover:text-gray-100"
                        >
                            haven't registered yet?
                        </Link>
                    </div>
                </div>

                <div class="flex w-full mt-8">

                    <JetButton
                        class="m-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Log in
                    </JetButton>
                </div>
            </form>
        </div>
    </div>
</template>
