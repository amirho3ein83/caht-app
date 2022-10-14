<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { onMounted, ref, toRef } from "vue";
import { useBioStore } from "@/stores/Bio.js";
import { managePageStore } from "@/stores/ManagePages";

const storePages = managePageStore();
let props = defineProps({
    user: Object,
});
// let socialMedia = ref([]);
let bioStore = useBioStore();

let pageLoaded = ref(false);

onMounted(() => {
    storePages.currentSidebar = 'ContactBio'
    bioStore.getSocialMedia();
    pageLoaded.value = true;
});

</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
 
export default {
  layout: AppLayout
}
</script>
<template>

        <div class="flex flex-col w-[420px] overflow-y-hidden justify-between" style="height: inherit;">
            <Transition name="bounce">
                <img
                    v-show="pageLoaded"
                    class="w-80 mx-auto h-2/4 object-cover rounded-t rounded-full"
                    :src="$page.props.user.profile"
                    :alt="$page.props.user.username"
                />
            </Transition>

            <Transition name="slide-fade">
                <div v-if="pageLoaded" class="mt-4">
                <div class="px-7 my-8 gap-2">
                    <h1
                        class="appearance-none bg-transparent w-full text-gray-400 text-3xl mr-3 py-1 px-2"
                    >
                        {{ $page.props.user.username }}
                    </h1>
                    <div
                        class="mt-5 flex items-center "
                    >
                        <h2
                            class="appearance-none bg-transparent w-full text-gray-400 text-lg mr-3 py-1 px-2"
                        >
                            {{ bioStore.socialMedia.bio }}
                        </h2>
                    </div>
                    <div
                        class="mt-5 flex text-start border-b border-gray-600"
                    >
                        <h2
                            class="appearance-none bg-transparent w-full text-gray-400 text-lg mr-3 py-1 px-2"
                        >
                            {{ $page.props.user.email }}
                        </h2>
                    </div>
                    <div
                        class="mt-5 flex text-start border-b border-gray-600 text-gray-300"
                    >
                        <i class="bi bi-telegram"></i>

                        <h2
                            class="appearance-none bg-transparent w-full text-gray-400 text-lg mr-3 py-1 px-2"
                        >
                            {{ bioStore.socialMedia.telegram }}
                        </h2>
                    </div>

                    <div
                        class="mt-5 flex text-start border-b border-gray-600 text-gray-300"
                    >
                        <i class="bi bi-instagram"></i>

                        <h2
                            class="appearance-none bg-transparent w-full text-gray-400 text-lg mr-3 py-1 px-2"
                        >
                            {{ bioStore.socialMedia.instagram }}
                        </h2>
                    </div>
                </div>
            </div>
            </Transition>

        </div>

</template>
