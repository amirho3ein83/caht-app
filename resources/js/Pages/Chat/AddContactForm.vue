<!-- <script setup>
import { useForm } from "@inertiajs/inertia-vue3";

let props = defineProps({
});
let search = ref('');
let contacts = ref(null);

watch(search, value => {
    if (value == '') {
        return;
    }

    axios
        .get("contacts/explore?search=" + value)
        .then((response) => {
            console.log(response);
            props.contacts = response.data;
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
            contacts: [],

        };
    },
    directives: {
    focus
  },
    watch: {
        search(value) {
            if (value == '') {
                this.contacts = [];
                return;
            }

            axios
                .get("contacts/explore?search=" + value)
                .then((response) => {
                    console.log(response);
                    this.contacts = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    methods: {
        addContact(username) {
            axios
                .get("/contact/" + username)
                .then((response) => {
                    console.log(username + " added to ur contact list");
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }

};
</script> 



<template>
    <!-- Main modal -->
    <div id="crypto-modal" tabindex="-1"
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex"
        aria-modal="true" role="dialog">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-gray-400 rounded-lg shadow dark:bg-gray-600">
                <button type="button"
                    class="absolute -top-3 -right-2.5 text-white bg-transparent bg-red-400 hover:bg-red-500 hover:text-white rounded-full text-sm p-1.5 ml-auto inline-flex items-center hover:animate-spin dark:hover:bg-gray-800 dark:hover:text-white"
                    @click="$emit('modalClosed')">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
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
                            placeholder="Search Contacts" required/>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="py-3" style="height: 460px">
                    <hr />

                    <div
                        class="my-2 space-y-3 h-full flex flex-col w-full flex-1 flex-end overflow-y-auto scrollbar-thumb-gray scrollbar-thumb-rounded scrollbar-track-gray-lighter scrollbar-w-2 scrolling-touch">
                        <h3 v-if="contacts.length != 0" class="ml-3 font-mono text-gray-400">
                            found {{ contacts.length }} result
                        </h3>
                        <h3 v-else class="ml-3 font-mono text-gray-400">
                            no results found
                        </h3>
                        
                        <div
                            class=" flex-end flex-col-reverse space-y-4 overflow-y-auto scrollbar-thumb-gray scrollbar-thumb-rounded scrollbar-track-gray-lighter scrollbar-w-2 scrolling-touch">
                            <div v-for="contact in contacts" :key="contact.id"
                                class="shadow-slate-100 shadow-inner flex mx-4 bg-gray-100 rounded-sm ">

                                <img class="w-10 sm:w-15 h-10 sm:h-15 rounded-full" :src="contact.profile"
                                    v-if="contact.profile" />

                                <i v-else
                                    class="bi bi-person-circle w-10 sm:w-16 h-10 sm:h-16 rounded-full text-gray-600"
                                    style="font-size: 39px;"></i>

                                <p class="flex-1 ml-3 text-center align-middle self-center">{{
                                contact.username
                                }}</p>

                                <button @click="addContact(contact.username)"
                                    class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-1 px-4 rounded-sm">
                                    Add
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
