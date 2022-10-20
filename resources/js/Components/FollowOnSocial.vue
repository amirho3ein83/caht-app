<script setup>
defineProps({
    instagram: String,
    telegram: String,
});
</script>

<template>
    <div
        class="group text-center relative inline-block rounded-full bg-gray-600 px-8 py-3 text-white"
    >
        <span
            class="text-sm text-center font-medium transition-opacity group-hover:opacity-0"
        >
            Follow On Social
        </span>

        <ul
            class="absolute inset-0 flex items-center justify-center gap-3 opacity-0 transition-opacity group-hover:opacity-100"
        >
            <li>
                <a
                    class="block rounded-full transition-opacity hover:opacity-90 focus:opacity-75 focus:outline-none"
                    target="_blank"
                >
                    <span class="sr-only"> instagram </span>

                    <i class="bi bi-instagram"></i>
                </a>
            </li>

            <li>
                <a
                    class="block rounded-full transition-opacity hover:opacity-90 focus:opacity-75 focus:outline-none"
                    href="/#"
                >
                    <span class="sr-only"> telegram </span>

                    <i class="bi bi-telegram"></i>
                </a>
            </li>

            <li>
                <a
                    class="block rounded-full transition-opacity hover:opacity-90 focus:opacity-75 focus:outline-none"
                    href="/#"
                >
                    <span class="sr-only"> twitter </span>

                    <i class="bi bi-twitter"></i>
                </a>
            </li>
        </ul>
    </div>
</template>
