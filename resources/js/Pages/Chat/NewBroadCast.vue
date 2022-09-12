<script setup>
import { ref, onMounted } from "vue";
import Spinner from "./Spinner.vue";

let dataFetched = ref(false);

let followings = ref(null);
let followers = ref(null);
const message = ref("");
const checkedAccounts = ref([]);

const getFollowers = () => {
    return axios
        .get("followers")
        .then((response) => {
            console.log(response.data);
            followers.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
};
const getFollowings = () => {
    return axios
        .get("followings")
        .then((response) => {
            followings.value = response.data;
            dataFetched = true;
        })
        .catch((error) => {
            console.log(error);
        });
};

const startBroadcasting = () => {
    axios
        .post("message/broadcasting", { chosenAccounts: checkedAccounts })
        .then((response) => {
            console.log("start broadcat");

            // this.$emit("broadcastStarted");
        })
        .catch((error) => {
            console.log(error);
        });
};

onMounted(() => {
    getFollowings();
    getFollowers();
});
</script>

<template>
    <!-- Main modal -->
    <div
        id="crypto-modal"
        tabindex="-1"
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-200 w-full md:inset-0 h-modal md:h-full justify-center items-center flex"
        aria-modal="true"
        role="dialog"
    >
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div
                class="relative bg-gray-400 rounded-lg shadow dark:bg-gray-500"
            >
                <button
                    type="button"
                    class="absolute -top-3 -right-2.5 text-white bg-transparent bg-red-400 hover:bg-red-500 hover:text-white rounded-full text-sm p-1.5 ml-auto inline-flex items-center hover:animate-spin dark:hover:bg-gray-800 dark:hover:text-white"
                    @click="$emit('broadcastStarted')"
                >
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div open class="overflow-hidden rounded">
                    <div class="py-4 px-6 rounded-t dark:border-gray-500">
                        <input
                            v-model="message"
                            class="block p-3 rounded pl-10 w-full text-sm text-gray-900 bg-gray-100 outline-none"
                            placeholder="message..."
                            required
                        />
                    </div>
                    <fieldset>
                        <legend
                            class="block w-full px-5 py-3 text-xs font-medium bg-gray-200"
                        >
                            followings
                        </legend>

                        <div class="px-5 py-6 space-y-2">
                            <Spinner v-if="!dataFetched" />
                            <div
                                v-for="following of followings"
                                :key="following.id"
                                class="flex items-center"
                            >
                                <input
                                    type="checkbox"
                                    v-model="checkedAccounts"
                                    :value="following.username"
                                    name="age[3+]"
                                    class="w-5 h-5 border-gray-300 rounded"
                                />

                                <label class="ml-3 text-sm font-medium">
                                    {{ following.username }}
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    <div>
                        <fieldset>
                            <legend
                                class="block w-full px-5 py-3 text-xs font-medium bg-gray-200"
                            >
                                followers
                            </legend>

                            <div class="px-5 py-6 space-y-2">
                            <Spinner v-if="!dataFetched" />

                                <div
                                    v-for="follower of followers"
                                    :key="follower.id"
                                    class="flex items-center"
                                >
                                    <input
                                        type="checkbox"
                                        v-model="checkedAccounts"
                                        :value="follower.username"
                                        name="age[3+]"
                                        class="w-5 h-5 border-gray-300 rounded"
                                    />

                                    <label class="ml-3 text-sm font-medium">
                                        {{ follower.username }}
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div>{{ checkedAccounts }}</div>

                    <div
                        class="flex justify-between px-5 py-3 border-t border-gray-200"
                    >
                        <button
                            @click="startBroadcasting()"
                            name="commit"
                            type="button"
                            class="px-5 py-3 text-xs font-medium text-white bg-green-500 rounded"
                        >
                            send
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
