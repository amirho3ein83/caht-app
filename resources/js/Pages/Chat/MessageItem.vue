<template>
    <div v-if="message.from != $page.props.user.id" class="flex items-end m-2">
        <div
            class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start"
        >
            <div>
                <p
                    class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600"
                >
                    {{ message.text }}
                    <span>{{ message.sent_datetime }}</span>
                    <i
                        class="bi bi-check2-all text-blue-400"
                        style="font-size: 16px"
                    ></i>
                    <i
                        class="bi bi-check2-all text-gray-400"
                        style="font-size: 16px"
                    ></i>
                </p>
            </div>
        </div>
        <img
            src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
            alt="My profile"
            class="w-8 h-8 rounded-full order-1"
        />
    </div>
    <!-- another style for contract -->
    <div v-else class="flex items-end justify-end  my-1 ">
        <div class="flex flex-col text-xs max-w-xs  mx-2 order-1 items-end">
            <div
                class="flex flex-row-reverse p-2 rounded-lg rounded-br-none bg-gray-500"
            >
            <!-- <i class="bi bi-suit-heart-fill text-red-700 absolute ml-3 mt-4" style="font-size: 16px;"></i> -->

                <!-- <i class="bi bi-check2-all text-blue-400" style="font-size: 16px;"></i> -->
                <!-- <i
                    class="bi bi-check2-all text-gray-300 ml-1"
                    style="font-size: 16px"
                ></i> -->
                <!-- <i class="bi bi-arrow-up-right-circle-fill transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-110  duration-200 " style="font-size: 20px;"></i> -->
                <span class="text-gray-800 text-xs ml-2 align-bottom">{{
                    message.sent_datetime
                }}</span>

                <p class="text-gray-200 text-sm">
                    {{ message.text }}
                </p>

            </div>
        </div>
        <img
            src="https://images.unsplash.com/photo-1590031905470-a1a1feacbb0b?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
            alt="My profile"
            class="w-8 h-8 rounded-full order-2"
        />
    </div>
</template>

<script>
export default {
    props: ["message"],
};
</script>
