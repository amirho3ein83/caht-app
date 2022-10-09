 <script setup>
import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { computed, ref, watch } from "vue";


let search = ref('');
let accounts = ref(null);

watch(search, value => {
    axios
        .get("accounts/explore?search=" + value)
        .then((response) => {
            console.log(response);
            accounts = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
})

const follow = (username) => {
    axios
        .get("/follow/" + username)
        .then((response) => {
            console.log(username + " followed");
        })
        .catch((error) => {
            console.log(error);
        });
}

</script>

<!-- <script>
import AppLayout from "@/Layouts/AppLayout.vue";

const focus = {
    mounted: (el) => el.focus(),
};
export default {
    // props: ["user"],
    data: function () {
        return {
            search: [],
            accounts: [],
        };
    },
    directives: {
        focus,
    },
    watch: {
        search(value) {
            if (value == "") {
                this.accounts = [];
                return;
            }

            axios
                .get("accounts/explore?search=" + value)
                .then((response) => {
                    console.log(response);
                    this.accounts = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    methods: {
        follow(username) {
            axios
                .get("/follow/" + username)
                .then((response) => {
                    console.log(username + " followed");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script> -->

<template>
    <AppLayout>
        <div class="py-4 px-6 rounded-t dark:border-gray-600">
            <div class="relative">
                <div
                    class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
                >
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5 text-gray-500 dark:text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        ></path>
                    </svg>
                </div>
                <input
                    v-model="search"
                    class="block p-3 rounded pl-10 w-full text-sm text-gray-900 bg-gray-100 outline-none"
                    placeholder="Search accounts"
                    required
                />
            </div>
            <hr />
        </div>

        <div class="py-3" style="height: 460px">
            <div
                class="my-2 space-y-3 h-full flex flex-col w-full flex-1 flex-end"
            >
                <h3
                    v-if="accounts.length != 0"
                    class="ml-3 font-mono text-slate-200"
                >
                    found {{ accounts.length }} result
                </h3>
<img src="https://i.pinimg.com/originals/e9/1e/3c/e91e3cb4378975fbd92f8f884c9273ea.jpg" alt="">

                <div
                    v-for="account in accounts"
                    :key="account.id"
                    class="flex justify-start text-gray-700 bg-gray-200 rounded-md px-2 py-2 my-2"
                >
                    <img
                        class="h-12 w-12 rounded-full object-cover"
                        :src="account.profile"
                        v-if="account.profile"
                    />

                    <p class="flex-1 ml-3 text-center align-middle self-center">
                        {{ account.username }}
                    </p>
                    <button
                        @click="follow(account.username)"
                        class="text-sm font-normal p-2 text-gray-700 tracking-wide cursor-pointer hover:text-green-400 transition hover:scale-110"
                    >
                        Follow
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template> -->
