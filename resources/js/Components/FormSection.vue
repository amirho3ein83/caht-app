<script setup>
import { computed, useSlots } from 'vue';
import JetSectionTitle from './SectionTitle.vue';

defineEmits(['submitted']);

const hasActions = computed(() => !! useSlots().actions);
</script>

<template>
    <div class="mx-auto max-w-lg">


        <div class="mt-5 md:mt-0 md:col-span-2 gap-2 text-center">
            <form @submit.prevent="$emit('submitted')">
                <div
                    class="px-4 py-5 bg-white sm:p-6 shadow"
                    :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'"
                >
                    <div class="flex flex-col">
                        <slot name="form" />
                    </div>
                </div>

                <div v-if="hasActions" class="flex items-center justify-center px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <slot name="actions" />
                </div>
            </form>
        </div>
    </div>
</template>
