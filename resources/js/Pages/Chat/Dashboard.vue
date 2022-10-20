<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { onMounted, ref, toRef } from "vue";
import { managePageStore } from "@/stores/ManagePages";
import FollowOnSocial from "@/Components/FollowOnSocial.vue";
import { useFFStore } from "@/stores/FF";
import { useChatsStore } from "@/stores/Chats.js";

const storeChats = useChatsStore();
const FFStore = useFFStore();

const storePages = managePageStore();

let props = defineProps({
    user: Object,
});

let pageLoaded = ref(false);

onMounted(() => {
    storePages.currentSidebar = "Dashboard";
    // user.showUserProfile(props.user.id);
    pageLoaded.value = true;
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,
};
</script>
<template>
    <div
        class="main h-full flex flex-col overflow-y-auto overflow-x-hidden w-full"
    >
        <Transition name="bounce">
            <img
                v-show="pageLoaded"
                class="w-60 mx-auto mt-4 h-1/2 object-cover rounded-t rounded-full"
                :src="user.profile"
                :alt="user.username"
            />
        </Transition>

        <Transition name="slide-fade">
            <div v-if="pageLoaded" class="h-1/2">
                <div
                    class="px-7 py-5 h-full gap-2 flex flex-col justify-between"
                >
                    <div>
                        <h1
                            class="text-center appearance-none bg-transparent w-full text-gray-400 text-3xl mr-3 py-1 px-2"
                        >
                            {{ user.username }}
                        </h1>

                        <h2
                            v-if="user.social_media"
                            class="appearance-none bg-transparent w-full text-gray-400 text-lg mr-3 py-1 px-2"
                        >
                            {{ user.social_media.bio }}
                        </h2>

                        <div class="flex justify-evenly">
                            <button
                                @click="storePages.setPage(`FollowersPage`)"
                                class="hover:bg-slate-800 rounded px-2 py-1"
                            >
                                <p class="text-cyan-500">Followers</p>
                                <p class="text-slate-400">
                                    {{ user.followers_count }}
                                </p>
                            </button>
                            <button
                                @click="storePages.setPage(`FollowingsPage`)"
                                class="hover:bg-slate-800 rounded px-2 py-1"
                            >
                                <p class="text-cyan-500">Followings</p>
                                <p class="text-slate-400">
                                    {{ user.followings_count }}
                                </p>
                            </button>
                        </div>
                    </div>
                    <!-- <div class="mt-5 flex text-start border-b border-gray-600">
                        <h2
                            class="appearance-none bg-transparent w-full text-gray-400 text-lg mr-3 py-1 px-2"
                        >
                            {{ user.email }}
                        </h2>
                    </div>
                    <div
                        class="mt-5 flex text-start border-b border-gray-600 text-gray-300"
                    >
                        <i class="bi bi-telegram"></i>

                        <h2
                            class="appearance-none bg-transparent w-full text-gray-400 text-lg mr-3 py-1 px-2"
                        >
                            {{ user.socialMedia.telegram }}
                        </h2>
                    </div>

                    <div
                        class="mt-5 flex text-start border-b border-gray-600 text-gray-300"
                    >
                        <i class="bi bi-instagram"></i>

                        <h2
                            class="appearance-none bg-transparent w-full text-gray-400 text-lg mr-3 py-1 px-2"
                        >
                            {{ user.socialMedia.instagram }}
                        </h2>
                    </div> -->
                    <FollowOnSocial
                        :instagram="user.instagram"
                        :telegram="user.telegram"
                    />
                </div>
            </div>
        </Transition>
    </div>
</template>
