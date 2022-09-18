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


    <div open class="overflow-hidden  flex flex-col align-end">

        <fieldset>
            <legend class="block w-full px-5 py-3 text-lg font-medium bg-gray-200">
                followings
            </legend>

            <div class="px-5 py-6 space-y-2">
                <Spinner v-if="!numberOfFollowings == 0" />
                <div v-for="following of followings" :key="following.id" class="flex items-center">
                    <input type="checkbox" v-model="checkedAccounts" :value="following.id" name="age[3+]"
                        class="w-5 h-5 border-gray-300 " />

                    <label class="ml-3 text-gray-100 text-lg font-medium">
                        {{ following.username }}
                    </label>
                </div>
            </div>
        </fieldset>

            <fieldset>
                <legend class="block w-full px-5 py-3 text-lg font-medium bg-gray-200">
                    followers
                </legend>

                <div class="px-5 py-6 space-y-2">
                    <Spinner v-if="!numberOfFollowers == 0" />

                    <div v-for="follower of followers" :key="follower.id" class="flex items-center">
                        <input type="checkbox" v-model="checkedAccounts" :value="follower.id" name="age[3+]"
                            class="w-5 h-5 border-gray-300 " />

                        <label class="ml-3 text-gray-100 text-lg font-medium">
                            {{ follower.username }}
                        </label>
                    </div>
                </div>
            </fieldset>
        <div>{{ checkedAccounts }}</div>

        <div class="flex  border-t border-gray-200">

            <div class="p-1 -t dark:border-gray-500">
                <input v-model="message"
                    class="block p-3  pl-10 w-full text-sm text-gray-900 bg-gray-100 outline-none"
                    placeholder="message..." required />
            </div>
            <button @click="startBroadcasting()" prevent-scroll type="button"
                class="inline-flex items-center justify-center -lg px-3 py-1 transition duration-500 ease-in-out text-white hover:bg-gray-600 bg-gray-500 focus:outline-none ml-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="h-6 w-6 ml-2 transform rotate-90">
                    <path
                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                    </path>
                </svg>
            </button>
            <button @click="startBroadcasting()" prevent-scroll type="button"></button>
        </div>
    </div>

</template>
