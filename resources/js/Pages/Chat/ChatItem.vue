<script setup>

const props = defineProps({
    chat: Object,
});

let chatTitle = (username) => {
    props.chat.name = props.chat.name.replace(
        username,
        ""
    );
    return props.chat.name;
};
</script>

<template>
    <!-- <a  class="cursor-pointer hover:opacity-80 ">
        <div class="bg-gray-500 rounded-l-full hover:bg-gray-400 shadow-r-30  m-2"
>
            <div class="justify-start p-1  align-baseline flex my-1 "
                >
                <div>

                    <img class="w-14 sm:w-16 h-14 sm:h-16 rounded-full" :src="$page.props.user.profile"
                        v-if="$page.props.user.profile" />
                    <i v-else class="bi bi-person-circle w-10 sm:w-16 h-10 sm:h-16 rounded-full text-gray-600"
                        style="font-size: 39px;"></i>
                </div>
                <div class="ml-2 flex-1 self-center ">
                    <p class="text-lg text-slate-900 bold">
                        {{ chatTitle($page.props.user.username) }}
                    </p>
                </div>

                <i class=" bi bi-3-circle-fill text-green-300 animate-pulse" style="font-size: 28px;"></i>
            </div>
        </div>
    </a> -->
      <div class="select-none cursor-pointer  flex flex-1 items-center p-4 hover:opacity-100 opacity-80 hover:bg-gray-600">
        <div class="flex flex-col w-10 h-10 justify-center items-center mr-4">
                    <img class="w-full rounded-full" :src="$page.props.user.profile"
                        v-if="$page.props.user.profile" />
                    <i v-else class="bi bi-person-circle w-10 sm:w-16 h-10 sm:h-16 rounded-full text-gray-600"
                        style="font-size: 39px;"></i>
        </div>
        <div class="flex-1 pl-1">
          <div class="text-gray-600 dark:text-gray-200 text-lg">{{ chatTitle($page.props.user.username) }}</div>
        </div>
        <div class="flex flex-row justify-center">
          <div class="text-gray-600 dark:text-gray-200 text-xs">6:00 AM</div>

        </div>
      </div>
</template>
