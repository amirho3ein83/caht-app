<script setup>
import { computed, useSlots } from "vue";
import JetSectionTitle from "./SectionTitle.vue";

defineEmits(["submitted"]);

const hasActions = computed(() => !!useSlots().actions);
</script>

<template>
    <div class="mx-auto max-w-lg">
        <div class="mt-5 md:mt-0 md:col-span-2 gap-2 text-center">
            <form @submit.prevent="$emit('submitted')">
                <div
                    class="px-4 py-5 bg-gradient-to-b from-gray-400 via-gray-400 to-gray-500 sm:p-6 shadow"
                    :class="
                        hasActions
                            ? 'sm:rounded-tl-md sm:rounded-tr-md'
                            : 'sm:rounded-md'
                    "
                >
                    <div class="flex flex-col">
                        <slot name="form" />
                    </div>
                    <div
                    v-if="hasActions"
                    class="flex items-center justify-center px-4 py-3 bg-none text-right mt-3 sm:px-6  sm:rounded-bl-md sm:rounded-br-md"
                >
                    <slot name="actions" />
                </div>
                </div>


            </form>
        </div>
    </div>
</template>
