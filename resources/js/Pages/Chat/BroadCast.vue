<script setup>
import { ref, onMounted } from "vue";
import Spinner from "./Spinner.vue";
import { storeToRefs } from "pinia";
import { useFollowersStore } from "@/stores/Followers";
import { useFollowingsStore } from "@/stores/Followings";
import AppLayout from "@/Layouts/AppLayout.vue";
import LoadingAnimation from "@/Components/LoadingAnimation.vue";

const storeFollowers = useFollowersStore();
storeFollowers.fill();

const storeFollowings = useFollowingsStore();
storeFollowings.fill();

const message = ref("");
const checkedAccounts = ref([]);

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

</script>

<template>
    <AppLayout>
        <div class="m-4 w-[420px] h-[750px] flex flex-col overflow-y-auto">
            <div
                open
                class="overflow-y-auto h-full flex flex-col flex-end align-end justify-between"
            >
                <div class="flex-1">
                    <legend
                        class="block w-full px-5 py-3 text-lg font-medium bg-stone-400"
                    >
                        followings
                    </legend>

                    <div
                        v-if="storeFollowings.followings.length != 0"
                        v-for="following of storeFollowings.followings"
                        :key="following.id"
                        class="select-none cursor-pointer flex flex-1 items-center p-2 hover:opacity-100 opacity-80 hover:bg-gray-600"
                    >
                        <div
                            class="flex flex-col w-12 h-12 justify-center items-center mr-4"
                        >
                            <img
                                class="w-12 h-12 object-cover rounded-full"
                                :src="$page.props.user.profile"
                                v-if="$page.props.user.profile"
                            />
                            <i
                                v-else
                                class="bi bi-person-circle w-12 sm:w-16 h-10 sm:h-16 rounded-full text-gray-600"
                                style="font-size: 39px"
                            ></i>
                        </div>
                        <div class="flex-1 pl-1">
                            <div
                                class="text-gray-300 dark:text-gray-200 text-lg"
                            >
                                {{ following.username }}
                            </div>
                        </div>
                        <div class="flex flex-row justify-center">
                            <input
                                v-model="checkedAccounts"
                                :value="following.username"
                                type="checkbox"
                                class="checkbox w-5 h-5 border-gray-300"
                            />
                        </div>
                    </div>
                    <LoadingAnimation v-else />
                </div>
                <div class="flex-1">
                    <legend
                        class="block w-full px-5 py-3 text-lg font-medium bg-stone-400"
                    >
                        followers
                    </legend>

                    <div
                        v-if="storeFollowers.followers.length != 0"
                        v-for="follower of storeFollowers.followers"
                        :key="follower.id"
                        class="select-none cursor-pointer flex flex-1 items-center p-2 hover:opacity-100 opacity-80 hover:bg-gray-600"
                    >
                        <div
                            class="flex flex-col w-12 h-12 justify-center items-center mr-4"
                        >
                            <img
                                class="w-12 h-12 object-cover rounded-full"
                                :src="$page.props.user.profile"
                                v-if="$page.props.user.profile"
                            />
                            <i
                                v-else
                                class="bi bi-person-circle w-10 sm:w-16 h-10 sm:h-16 rounded-full text-gray-600"
                                style="font-size: 39px"
                            ></i>
                        </div>
                        <div class="flex-1 pl-1">
                            <div
                                class="text-gray-300 dark:text-gray-200 text-lg"
                            >
                                {{ follower.username }}
                            </div>
                        </div>
                        <div class="flex flex-row justify-center">
                            <input
                                v-model="checkedAccounts"
                                :value="follower.username"
                                type="checkbox"
                                class="w-5 h-5 border-gray-300"
                            />
                        </div>
                    </div>
                    <LoadingAnimation v-else />
                </div>
            </div>
            <div class="flex mb-5 -space-x-4 bg-stone-400 rounded-full">
                <img 
                v-for="account of checkedAccounts "
                    class="w-10 h-10 rounded-full  dark:border-gray-800"
                    :src="$page.props.user.profile"
                    alt=""
                />
            </div>
            <div class="flex border-gray-200 sticky bottom-0">
                <div class="p-1 flex-1 -t dark:border-gray-500">
                    <input
                        v-model="message"
                        class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-100 outline-none"
                        placeholder="message..."
                        required
                        @keyup.enter="startBroadcasting()"
                    />
                </div>
                <button
                    prevent-scroll
                    type="button"
                    class="inline-flex items-center justify-center -lg px-2 py-1 transition duration-500 ease-in-out text-white hover:bg-gray-600 bg-gray-500 focus:outline-none ml-1"
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
    </AppLayout>
</template>
