<script setup>
import { onMounted, ref } from "vue";
import { managePageStore } from "@/stores/ManagePages";

const storePages = managePageStore();

const currentMode = ref("light");

onMounted(() => {
    storePages.currentSidebar = "Settings";
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,
};
</script>
<template>
    <div 
    class="main h-full flex flex-col overflow-y-auto overflow-x-hidden w-full"
    >
        <section
            class="my-3 border-b-2 border-gray-500 p-2 py-4 flex justify-evenly"
        >
            <button
                type="submit"
                class="w-35 active:bg-purple-800 bg-purple-600 inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-100 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
            >
                chabge mode
            </button>
            <div>
                <i
                    @click="currentMode == 'light'"
                    v-if="currentMode == 'light'"
                    class="bi bi-brightness-low text-c-orange"
                ></i>
                <i
                    @click="currentMode == 'dark'"
                    v-if="currentMode == 'dark'"
                    class="bi bi-moon-stars text-c-orange"
                ></i>
            </div>
        </section>

        <section class="flex gap-3 w-full border-b-2 border-gray-500 py-4">
  <div class="relative">
    <input
      class="group peer hidden"
      type="radio"
      name="shippingOption"
      value="standard_alt"
      id="standard_alt"
    />

    <label
      class="block cursor-pointer rounded-lg border border-gray-100 p-4 text-sm font-medium shadow-sm transition-colors hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:ring-1 peer-checked:ring-blue-500"
      for="standard_alt"
    >
      <span> Standard </span>

      <span class="mt-1 block text-xs text-gray-500"> Free </span>
    </label>

    <svg
      class="absolute top-4 right-4 h-5 w-5 text-blue-600 opacity-0 peer-checked:opacity-100"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 20 20"
      fill="currentColor"
    >
      <path
        fill-rule="evenodd"
        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
        clip-rule="evenodd"
      />
    </svg>
  </div>

  <div class="relative">
    <input
      class="group peer hidden"
      type="radio"
      name="shippingOption"
      value="next_day_alt"
      id="next_day_alt"
    />

    <label
      class="block cursor-pointer rounded-lg border border-gray-100 p-4 text-sm font-medium shadow-sm transition-colors hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:ring-1 peer-checked:ring-blue-500"
      for="next_day_alt"
    >
      <span> Next Day </span>

      <span class="mt-1 block text-xs text-gray-500"> $ 5.99 </span>
    </label>

    <svg
      class="absolute top-4 right-4 h-5 w-5 text-blue-600 opacity-0 peer-checked:opacity-100"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 20 20"
      fill="currentColor"
    >
      <path
        fill-rule="evenodd"
        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
        clip-rule="evenodd"
      />
    </svg>
  </div>

        </section>

        <section class="border-b-2 p-2 py-4 border-gray-500">
            <label
                for="large-toggle"
                class="inline-flex relative items-center cursor-pointer"
            >
                <input
                    type="checkbox"
                    value=""
                    id="large-toggle"
                    class="sr-only peer"
                />
                <div
                    class="w-14 h-7 bg-gray-400 peer-focus:outline-none rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-yellow-600"
                ></div>
                <span
                    class="ml-3 text-lg font-medium text-gray-100 dark:text-gray-300"
                    >Private Account</span
                >
            </label>
            <p class="text-gray-300 p-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis,
                non optio deleniti ducimus dignissimos natus in ex libero
                dolorem illum.
            </p>
        </section>
    </div>
</template>
<style scoped>
i {
    font-size: 40px;
}
</style>
