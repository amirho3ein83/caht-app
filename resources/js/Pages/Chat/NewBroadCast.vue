<script setup>
import { ref, onMounted } from "vue";
import Spinner from "./Spinner.vue";

let numberOfFollowings = ref(0);
let numberOfFollowers = ref(0);


let followings = ref(null);
let followers = ref(null);
const message = ref("");
const checkedAccounts = ref([]);

const getFollowers = () => {
    return axios
        .get("followers")
        .then((response) => {
            numberOfFollowers = response.data.length;
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
            numberOfFollowings = response.data.length;

            followings.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
};

const startBroadcasting = () => {
    axios
        .post("message/broadcasting", {
            chosenAccounts: checkedAccounts.value,
            message: message.value,
        })
        .then((response) => {
            console.log("start broadcat");

            this.$emit("broadcastStarted");
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
<div class="z-20">
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
                            <Spinner v-if="!numberOfFollowings == 0" />
                            <div
                                v-for="following of followings"
                                :key="following.id"
                                class="flex items-center"
                            >
                                <input
                                    type="checkbox"
                                    v-model="checkedAccounts"
                                    :value="following.id"
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
                                <Spinner v-if="!numberOfFollowers == 0" />

                                <div
                                    v-for="follower of followers"
                                    :key="follower.id"
                                    class="flex items-center"
                                >
                                    <input
                                        type="checkbox"
                                        v-model="checkedAccounts"
                                        :value="follower.id"
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
                            prevent-scroll
                            type="button"
                            class="inline-flex items-center justify-center rounded-lg px-3 py-2 transition duration-500 ease-in-out text-white hover:bg-gray-600 bg-gray-500 focus:outline-none ml-1"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                class="h-6 w-6 ml-2 transform rotate-90"
                            >
                                <path
                                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"
                                ></path>
                            </svg>
                        </button>
                        <button
                            @click="startBroadcasting()"
                            prevent-scroll
                            type="button"
                        ></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
