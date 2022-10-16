<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";

defineEmits(["message-deleted"]);


let props = defineProps({
    message: Object,
});

let showDetails = ref(false);

const deleteMessageForm = useForm();

const deleteMessage = () => {
    deleteMessageForm.delete(
        route("delete.message", { message: props.message }),
        {
            preserveScroll: true,
            preserveState: true,
        }
    );
};

let showMessage = ref(false);
onMounted(() => {
    setTimeout(() => {
        showMessage.value = true;
    }, 1);
});
</script>

<template>
    <Transition >
<template v-if="showMessage">

    <div
        v-if="message.from != $page.props.user.id"
        class="flex items-end justify-start my-1"
    >
        <div class="flex flex-col text-sm max-w-lg mx-2 order-1 items-end">
            <div class="flex flex-col rounded-lg rounded-bl-none bg-gray-200">
                <!-- like -->
                <!-- <i class="bi bi-suit-heart-fill text-red-700 absolute ml-3 mt-4" ></i> -->
                <!-- seen -->
                <p class="text-gray-800  sm:text-xl mx-2 px-4 py-1">
                    {{ message.text }}
                </p>
                <div class="justify-end flex items-center mr-1">

                    <span class="text-yellow-800 text-sm ml-2 align-bottom">{{
                        message.sent_datetime
                    }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- another style for contract -->
    <div v-else class="flex items-end justify-end my-1">
        <div
            @click="showDetails = !showDetails"
            class="flex flex-col text-sm max-w-lg mx-2 order-1 items-end"
        >
            <div class="flex flex-col rounded-lg rounded-br-none bg-gray-700">
                <!-- like -->
                <!-- <i class="bi bi-suit-heart-fill text-red-700 absolute ml-3 mt-4" ></i> -->
                <!-- seen -->
                <p class="text-gray-100  sm:text-xl mx-2 px-4 py-1">
                    {{ message.text }}
                </p>
                <div class="justify-between flex items-center mr-1">
                    <!-- <i class="bi bi-check2-all text-blue-600"></i> -->
                    <i
                    v-if="message.seen"
                        class="bi bi-check2-all text-blue-300 ml-1"
                        style="font-size: 20px"
                    ></i>
                    <i
                    v-else
                        class="bi bi-check2 text-blue-500 ml-1"
                        style="font-size: 20px"
                    ></i>

                    <span class="text-yellow-300 text-sm ml-2 align-bottom">{{
                        message.sent_datetime
                    }}</span>
                </div>
            </div>
        </div>

        <!-- message details -->
        <div v-if="showDetails" class="bg-gray-400 rounded-lg p-2 z-30">
            <ul class="py-1 gap-1 text-sm text-gray-700 dark:text-gray-200">
                <li class="flex items-center hover:bg-gray-600 justify-between">
                    <i
                        class="px-1 bi bi-suit-heart-fill text-red-700 text-2xl"
                    ></i>

                    <p class="px-1 text-xl">like</p>
                </li>
                <li class="flex items-center hover:bg-gray-600 justify-between">
                    <i
                        class="px-1 bi bi-arrow-90deg-right text-gray-700 text-2xl"
                    ></i>

                    <p class="px-1 text-xl">reply</p>
                </li>
                <li
                    @click="deleteMessage"
                    class="flex items-center hover:bg-gray-600 justify-between"
                >
                    <i class="px-1 bi bi-trash3 text-red-700 text-2xl"></i>

                    <p class="px-1 text-xl">delete</p>
                </li>
            </ul>
        </div>
    </div>
</template>
</Transition >

</template>
