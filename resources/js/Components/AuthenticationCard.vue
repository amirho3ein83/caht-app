<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-gray-400 via-gray-500 to-gray-600"
    >


        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gradient-to-b from-gray-300 via-gray-400 to-gray-500 shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
