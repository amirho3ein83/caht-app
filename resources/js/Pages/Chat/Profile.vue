<script setup>
import { onMounted, ref } from "vue";
import FollowOnSocial from "@/Components/FollowOnSocial.vue";
import { useFFStore } from "@/stores/FF";

let props = defineProps({
    person: Object,
});

const FFStore = useFFStore();

let pageLoaded = ref(false);

onMounted(() => {
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
                class="w-60 mx-auto mt-4 h-60 object-cover rounded-full"
                :src="person.profile"
                :alt="person.username"
            />
        </Transition>

        <Transition name="slide-fade">
            <div v-if="pageLoaded" class="flex-1">
                <div
                    class="px-7 py-5 h-full gap-2 flex flex-col justify-between"
                >
                    <div>
                        <h1
                            class="text-center appearance-none bg-transparent w-full text-gray-400 text-2xl mr-3 py-1 px-2"
                        >
                            {{ person.username }}
                        </h1>

                        <h2
                            v-if="person.social_media"
                            class="appearance-none bg-transparent w-full text-gray-400 text-lg mr-3 py-1 px-2"
                        >
                            {{ person.social_media.bio }}
                        </h2>

                        <div class="flex justify-evenly">
                            <button
                                @click="storePages.setPage(`FollowersPage`)"
                                class="hover:bg-slate-800 rounded px-2 py-1"
                            >
                                <p class="text-cyan-500">Followers</p>
                                <p class="text-slate-400">
                                    {{ person.followers_count }}
                                </p>
                            </button>
                            <button
                                @click="storePages.setPage(`FollowingsPage`)"
                                class="hover:bg-slate-800 rounded px-2 py-1"
                            >
                                <p class="text-cyan-500">Followings</p>
                                <p class="text-slate-400">
                                    {{ person.followings_count }}
                                </p>
                            </button>
                        </div>
                        <div class="sm:flex sm:gap-4 mt-3">
                            <button
                                v-if="person.following"
                                @click="FFStore.unFollow(person.id)"
                                class="text-sm w-1/2 p-2 font-normal px-1 hover:bg-red-600 bg-red-500 rounded text-gray-100 tracking-wide cursor-pointer hover:text-gray-50 transition hover:scale-105"
                            >
                                unFollow
                            </button>
                            <button
                                v-else-if="person.follow_back_suggest"
                                @click="FFStore.follow(person.id)"
                                class="text-sm w-1/2 p-2 font-normal px-1 hover:bg-pink-700 bg-pink-600 rounded text-gray-100 tracking-wide cursor-pointer hover:text-gray-50 transition hover:scale-105"
                            >
                                Follow back
                            </button>
                            <button
                                v-else
                                @click="FFStore.follow(person.id)"
                                class="text-sm w-1/2 p-2 font-normal px-1 hover:bg-indigo-600 bg-indigo-500 rounded text-gray-100 tracking-wide cursor-pointer hover:text-gray-50 transition hover:scale-105"
                            >
                                Follow
                            </button>

                            <button
                                @click="storeChats.createChat(person.username)"
                                class="text-sm w-1/2 p-2 font-normal px-1 hover:bg-amber-600 bg-amber-700 rounded text-gray-100 tracking-wide cursor-pointer hover:text-gray-50 transition hover:scale-105"
                            >
                                Message
                            </button>
                        </div>
                    </div>
                    <!-- <div class="mt-5 flex text-start border-b border-gray-600">
                        <h2
                            class="appearance-none bg-transparent w-full text-gray-400 text-lg mr-3 py-1 px-2"
                        >
                            {{ person.email }}
                        </h2>
                    </div>
                    <div
                        class="mt-5 flex text-start border-b border-gray-600 text-gray-300"
                    >
                        <i class="bi bi-telegram"></i>

                        <h2
                            class="appearance-none bg-transparent w-full text-gray-400 text-lg mr-3 py-1 px-2"
                        >
                            {{ person.socialMedia.telegram }}
                        </h2>
                    </div>

                    <div
                        class="mt-5 flex text-start border-b border-gray-600 text-gray-300"
                    >
                        <i class="bi bi-instagram"></i>

                        <h2
                            class="appearance-none bg-transparent w-full text-gray-400 text-lg mr-3 py-1 px-2"
                        >
                            {{ person.socialMedia.instagram }}
                        </h2>
                    </div>
                 -->
                    <FollowOnSocial
                        :instagram="person.instagram"
                        :telegram="person.telegram"
                    />
                </div>
            </div>
        </Transition>
    </div>
</template>
