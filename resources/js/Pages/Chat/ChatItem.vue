<script setup>

const props = defineProps({
    chat: Object,
    currentChat: Object,
});

let chatTitle = (username) => {
    props.chat.following = props.chat.name.replace(
        username,
        ""
    );
    return props.chat.following;
};
</script>

<template>
    <a @click="$emit('chatChanged', chat)" class="cursor-pointer hover:opacity-80 ">
        <div class="bg-gray-500 rounded-l-full hover:bg-gray-400 shadow-r-30"
        :class="{'bg-gray-400':currentChat.id == chat.id}">
            <div class="justify-start p-1  align-baseline flex my-1 "
                >
                <div>

                    <img class="w-8 sm:w-14 h-8 sm:h-14 rounded-full" :src="$page.props.user.profile"
                        v-if="$page.props.user.profile" />
                    <i v-else class="bi bi-person-circle w-10 sm:w-16 h-10 sm:h-16 rounded-full text-gray-600"
                        style="font-size: 39px;"></i>
                </div>
                <div class="ml-2 flex-1 self-center ">
                    <p class="text-lg text-slate-900 bold">
                        {{ chatTitle($page.props.user.username) }}
                    </p>
                </div>

                <!-- <i class=" bi bi-3-circle-fill text-green-300 animate-pulse" style="font-size: 28px;"></i> -->
            </div>
        </div>
    </a>
</template>
