<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Components/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetLabel from "@/Components/Label.vue";

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
</script>




<template>
    <div class="flex">
        <img
            class="object-cover w-full h-screen"
            src="https://free4kwallpapers.com/uploads/originals/2022/01/20/astronaut-digital-art-wallpaper.jpg"
            alt=""
        />
        <div
            style="left: 100px; top: 90px"
            class="w-2/4 max-w-xl p-8 absolute m-5 backdrop-blur-sm bg-white/20"
        >
            <form @submit.prevent="submit" >
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
                <JetInputError class="mt-2" :message="form.errors.username" />
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
                <JetInputError class="mt-2" :message="form.errors.password" />
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
                class="text-lg animate-pulse align-middle  text-gray-200 hover:text-gray-900"
            >
                Already registered?
            </Link>
                </div>
            </form>
        </div>
        <!-- <form @submit.prevent="submit" class="absolute m-5 p-5 r-2">

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
    
            <div class="block mt-4">
                <label class="flex items-center">
                    <JetCheckbox
                        v-model:checked="form.remember"
                        name="remember"
                    />
                    <span class="ml-2 text-lg text-gray-200">Remember me</span>
                </label>
            </div>
    
            <div class="mt-4 flex-col">
                <div class="flex justify-between mx-2 my-2">
                    <Link
                        :href="route('password.request')"
                        class="underline text-lg text-gray-300 hover:text-gray-100"
                    >
                        Forgot your password?
                    </Link>
                    <Link
                        :href="route('register')"
                        class=" text-lg animate-pulse text-gray-300 hover:text-gray-100"
                    >
                        haven't registered yet?
                    </Link>
                </div>
                <div class="flex justify-center">
                    <JetButton
                        class="m-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Log in
                    </JetButton>
                </div>
            </div>
        </form> -->
    </div>
</template>

<!-- <template>
    <Head title="Register" />

    <JetAuthenticationCard>
        <form @submit.prevent="submit">

            <div class="mt-4">

                <JetLabel for="profile" value="profile" />
                <JetInput
                    id="profile"
                    v-model="form.profile"
                    type="file"
                    class="mt-1 block w-full"
                    
                />
                <JetInputError class="mt-2" :message="form.errors.profile" />
            </div>
            <div class="mt-4">

                    required
                />
                <JetInputError class="mt-2" :message="form.errors.profile" />
            </div>
            <div class="mt-4">
                <JetLabel for="username" value="username" />
                <JetInput
                    id="username"
                    v-model="form.username"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <JetInputError class="mt-2" :message="form.errors.username" />
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
                <JetInputError class="mt-2" :message="form.errors.password" />
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

            <div
                v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
                class="mt-4"
            >
                <JetLabel for="terms">
                    <div class="flex items-center">
                        <JetCheckbox
                            id="terms"
                            v-model:checked="form.terms"
                            name="terms"
                        />

                        <div class="ml-2">
                            I agree to the
                            <a
                                target="_blank"
                                :href="route('terms.show')"
                                class="underline text-sm text-gray-600 hover:text-gray-900"
                                >Terms of Service</a
                            >
                            and
                            <a
                                target="_blank"
                                :href="route('policy.show')"
                                class="underline text-sm text-gray-600 hover:text-gray-900"
                                >Privacy Policy</a
                            >
                        </div>
                    </div>
                </JetLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="text-lg animate-pulse text-gray-200 hover:text-gray-900"
                >
                    Already registered?
                </Link>

                <JetButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </JetButton>
            </div>
        </form>
    </JetAuthenticationCard>
</template> -->
