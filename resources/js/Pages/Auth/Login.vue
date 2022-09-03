<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Components/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetLabel from "@/Components/Label.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    username: "",
    password: "",
    // remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        // remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Log in" />

    <JetAuthenticationCard>
        <template #logo>
            <JetAuthenticationCardLogo />
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <JetLabel for="username" value="username" />
                <JetInput
                    id="username"
                    v-model="form.username"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
                <JetInputError class="mt-2" :message="form.errors.username" />
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

            <!-- <div class="block mt-4">
                <label class="flex items-center">
                    <JetCheckbox
                        v-model:checked="form.remember"
                        name="remember"
                    />
                    <span class="ml-2 text-sm text-gray-200">Remember me</span>
                </label>
            </div> -->

            <div class="mt-4 flex-col">
                <div class="flex justify-between mx-2 my-2">
                    <!-- <Link
                        :href="route('password.request')"
                        class="underline text-sm text-gray-300 hover:text-gray-100"
                    >
                        Forgot your password?
                    </Link> -->
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
        </form>
    </JetAuthenticationCard>
</template>
