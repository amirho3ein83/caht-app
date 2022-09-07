<script setup>
defineProps({
    message: Object,
});
</script>

<template>
    <div v-if="message.from != $page.props.user.id" class="flex items-end">
        <div class="flex flex-col text-xs max-w-xs mx-2 order-1 items-end">
            <div class="flex flex-row-reverse p-2 rounded-lg rounded-br-none bg-gray-300">
                <!-- <i class="bi bi-suit-heart-fill text-red-700 absolute ml-3 mt-4" ></i> -->

                <!-- <i class="bi bi-check2-all text-blue-400" ></i> -->
                <!-- <i
                    class="bi bi-check2-all text-gray-300 ml-1"
                    style="font-size: 16px"
                ></i> -->
                <!-- <i class="bi bi-arrow-up-right-circle-fill transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-110  duration-200 " style="font-size: 20px;"></i> -->
                <span class="text-gray-800 text-xs ml-2 align-bottom">{{
                    message.sent_datetime
                }}</span>

                <p class="text-gray-700 text-sm">
                    {{ message.text }}
                </p>
            </div>
        </div>
    </div>
    <!-- another style for contract -->
    <div v-else class="flex items-end justify-end my-1">
        <div class="flex flex-col text-xs max-w-xs mx-2 order-1 items-end">
            <div class="flex flex-col  rounded-lg rounded-br-none bg-gray-400">
                <!-- like -->
                <!-- <i class="bi bi-suit-heart-fill text-red-700 absolute ml-3 mt-4" ></i> -->
                <!-- seen -->
                <p class="text-gray-700 sm:text-lg text-sm mx-2  px-4 py-1">
                    {{ message.text }}
                </p>
                <div class="justify-end flex items-center mr-1">
                    <!-- <i class="bi bi-check2-all text-blue-600"></i> -->
                    <i class="bi bi-check2-all text-gray-200 ml-1" style="font-size: 20px;"></i>

                    <span class="text-gray-800 text-xs ml-2 align-bottom">{{
                        message.sent_datetime
                    }}</span>
                </div>


            </div>
        </div>
    </div>
</template>

