<template>
    <div class="flex justify-between px-4 pt-4 mb-2 sm:mb-0">
        <input
            v-model="message"
            @keyup.enter="sendMessage()"
            @keyup="enableButton()"
            type="text"
            placeholder="..."
            class="w-72 focus:outline-none text-gray-600 0 pl-12 bg-gray-200 focus:ring focus:ring-gray-600 rounded-md py-2"
        />
        <button
            @click="sendMessage()"
            prevent-scroll
            type="button"
            :disabled="isDisabled"
            :class="{ 'hover:bg-gray-600': !isDisabled }"
            class="inline-flex items-center justify-center rounded-lg px-3 py-2 transition duration-500 ease-in-out text-white bg-gray-500 focus:outline-none ml-1"
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
    </div>
</template>

<script>
import JetInput from "@/Components/Input.vue";
import JetButton from "@/Components/Button.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        JetInput,
        JetButton,
    },
    data: function () {
        return {
            message: "",
            isDisabled: true,
        };
    },
    props: ["conversation"],
    methods: {
        sendMessage() {
            if (this.message == "") {
                alert("enter sth");
            }
            axios
                .post(
                    "/chat/conversations/" + this.conversation.id + "/message",
                    {
                        text: this.message,
                        from: this.conversation.pivot.contact_id,
                    }
                )
                .then((response) => {
                    this.message = "";
                    // this.$emit("messagesent");
                    console.log("last message set after sending message");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        enableButton() {
            this.isDisabled = false;
        },
    },
};
</script>
