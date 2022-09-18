<!-- <script setup>
import { useForm } from "@inertiajs/inertia-vue3";

let props = defineProps({
});
let search = ref('');
let accountss = ref(null);

watch(search, value => {
    if (value == '') {
        return;
    }

    axios
        .get("accountss/explore?search=" + value)
        .then((response) => {
            console.log(response);
            props.accountss = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
});

</script> -->



<script>

const focus = {
  mounted: (el) => el.focus()
}

export default {
    // props: ["user"],
    data: function () {
        return {
            search: [],
            accounts: [],

        };
    },
    directives: {
    focus
  },
    watch: {
        search(value) {
            if (value == '') {
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
        }
    }

};
</script> 



<template>

            <!-- Modal content -->
            <div class=" relative bg-gray-400 rounded-lg shadow dark:bg-gray-600 h-full">
                <!-- Modal header -->
                <div class="py-4 px-6 rounded-t dark:border-gray-600">
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input v-focus v-model="search" class=" block p-3 rounded pl-10 w-full text-sm text-gray-900 bg-gray-100 outline-none"
                            placeholder="Search accounts" required/>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="py-3" style="height: 460px">
                    <hr />

                    <div
                        class="my-2 space-y-3 h-full flex flex-col w-full flex-1 flex-end ">
                        <h3 v-if="accounts.length != 0" class="ml-3 font-mono text-gray-400">
                            found {{ accounts.length }} result
                        </h3>
                        <h3 v-else class="ml-3 font-mono text-gray-400">
                            no results found
                        </h3>
                        
                            <div v-for="account in accounts" :key="account.id"
                                class="shadow-slate-100 shadow-inner flex mx-4 bg-gray-100 rounded-sm ">

                                <img class="w-10 sm:w-15 h-10 sm:h-15 rounded-full" :src="account.profile"
                                    v-if="account.profile" />

                                <i v-else
                                    class="bi bi-person-circle w-10 sm:w-16 h-10 sm:h-16 rounded-full text-gray-600"
                                    style="font-size: 39px;"></i>

                                <p class="flex-1 ml-3 text-center align-middle self-center">{{
                                account.username
                                }}</p>

                                <button @click="follow(account.username)"
                                    class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-1 px-4 rounded-sm">
                                    follow
                                </button>

                        </div>
                    </div>
                </div>
            </div>

</template>
