<template>
    <a
        @click="$emit('roomChanged', conversation)"
        class="cursor-pointer hover:opacity-80"
    >
        <div
            class="justify-between p-2 transition ease-in-out delay-25 mx-2 align-baseline flex my-1 bg-gray-400 hover:scale-105 hover:bg-gray-400 duration-30 rounded-md"
        >
            <div class="flex-col flex">
                <p class="text-sm break-words bold">
                    {{ chatTitle($page.props.contact.username) }}
                </p>
                <!-- {{ $page.props.contact.username }} -->
            </div>
            <div
                class="overflow-hidden relative w-8 h-8 bg-gray-100 rounded-full dark:bg-gray-600"
            >
A
            </div>
            <!-- <i class="bi bi-3-circle-fill text-green-500" style="font-size: 22px;"></i> -->
        </div>
    </a>
</template>

<script>
export default {
    props: ["conversation","second_contact"],
    methods: {
        chatTitle(username) {
            this.conversation.second_contact = this.conversation.name.replace(username, "")
            return this.conversation.second_contact;
        },
    },
};
</script>
