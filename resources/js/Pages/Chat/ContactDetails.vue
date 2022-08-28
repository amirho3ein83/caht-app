<template>
    <div class="flex sm:items-center justify-between py-3">
        <div class="relative flex items-center space-x-4">
            <div class="relative p-1">
                <div class="relative">
                    <img
                        src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
                        alt=""
                        class="w-10 sm:w-16 h-10 sm:h-16 rounded-full"
                    />
                    
                    <div
                        v-if="$page.props.user == 6"
                        class="absolute button-0 right-0 -mr-0 -mt-4 w-4 h-4 rounded-full bg-green-400 animate-ping"
                    ></div>
                    <div
                        v-if="$page.props.user"
                        class="absolute button-0 right-0 -mr-0 -mt-4 w-4 h-4 rounded-full bg-green-400"
                    ></div>
                </div>
            </div>
            <div class="flex flex-col leading-tight">
                <div class="text-2xl mt-1 flex items-center">
                    <span class="text-gray-100 mr-3"> contact.name </span>
                </div>
                <span  class="text-sm text-gray-100"
                    >Online (status)</span
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["contact"],
};
</script>
