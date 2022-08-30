<template>
    <a
        @click="$emit('roomChanged', conversation)"
        class="cursor-pointer hover:opacity-80"
    >
        <div
            class="justify-between p-2 transition ease-in-out delay-25 mx-2 flex my-1 bg-gray-400 hover:scale-105 hover:bg-gray-400 duration-30 rounded-md"
        >
            <div
                class="overflow-hidden relative w-7 h-7 bg-gray-100 rounded-full dark:bg-gray-600"
            >
                <img
                    src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
                    alt=""
                    class="w-10 sm:w-16 h-10 sm:h-16 rounded-full"
                />
            </div>
            <p>
                {{ conversation.name }}
            </p>
        </div>
    </a>
</template>

<script>
export default {
    props: ["conversation"],
};
</script>
