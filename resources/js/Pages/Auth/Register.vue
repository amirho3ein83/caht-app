<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Components/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetLabel from "@/Components/Label.vue";
import { ref ,onMounted} from "vue";

let showForm = ref(false)

const form = useForm({
    profile: null,
    email: "",
    username: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};

onMounted(()=>{
    setTimeout(() => {
    showForm.value = true
}, 50);
})
</script>

<template>
    
    <div class="flex" 
    >
    <img
    class="object-cover w-full h-screen"
    src="https://free4kwallpapers.com/uploads/originals/2022/01/20/astronaut-digital-art-wallpaper.jpg"
    alt=""
    />
    <Transition name="slide-fade">
    <div
    v-if="showForm"

            style="left: 100px; top: 90px"
            class="w-2/4 max-w-xl p-8 absolute m-5 backdrop-blur-sm bg-white/20"
        >
            <form @submit.prevent="submit">
                <h1 class="text-2xl font-bold mb-4">Sign in to your account</h1>

                <div class="mt-4">
                    <JetLabel for="username" value="username" />
                    <JetInput
                        id="username"
                        v-model="form.username"
                        type="text"
                        class="mt-1 block w-full"
                        required
                    />
                    <JetInputError
                        class="mt-2"
                        :message="form.errors.username"
                    />
                </div>
                <div class="mt-4">
                    <JetLabel for="email" value="email" />
                    <JetInput
                        id="email"
                        v-model="form.email"
                        type="text"
                        class="mt-1 block w-full"
                        required
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
                        autocomplete="new-password"
                    />
                    <JetInputError
                        class="mt-2"
                        :message="form.errors.password"
                    />
                </div>

                <div class="mt-4">
                    <JetLabel
                        for="password_confirmation"
                        value="Confirm Password"
                    />
                    <JetInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                    <JetInputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>

                <div class="flex w-full mt-8 justify-between items-baseline">
                    <JetButton
                        class="m-4 w-1/2"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Sign up
                    </JetButton>
                    <Link
                        :href="route('login')"
                        class="text-lg animate-pulse align-middle text-gray-200 hover:text-gray-900"
                    >
                        Already registered?
                    </Link>
                </div>
            </form>
        </div>
    </Transition>
    </div>

</template>


