<template>
        <div v-if="message.from != $page.props.user.id"  class="flex items-end m-2">
            <div
                class=" flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start"
            >
                <div>
                    <p
                        class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600"
                    >
                        {{ message.text }}
                        <!-- <span
                            >{{ message.sent_datetime}}</span
                        > -->
                    </p>
                </div>
            </div>
            <img
                src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
                alt="My profile"
                class="w-6 h-6 rounded-full order-1"
            />
    </div>
    <!-- another style for contract -->
        <div v-else class="flex items-end justify-end m-2">
            <div
                class="flex flex-col  text-xs max-w-xs mx-2 order-1 items-end"
            >
                <div>
                    <p
                        class=" px-4 py-2 rounded-lg inline-block rounded-br-none bg-gray-500 text-gray-200"
                    >
                        {{ message.text }}
                        <!-- <span
                            >{{ message.sent_datetime}}</span
                        > -->
                    </p>
                </div>
            </div>
            <img
                src="https://images.unsplash.com/photo-1590031905470-a1a1feacbb0b?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
                alt="My profile"
                class="w-6 h-6 rounded-full order-2"
            />
    </div>
</template>

<script>
export default {
    props: ["message"],
};
</script>
