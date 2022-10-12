<script setup>
import LogoutModal from "./Modals/LogoutModal.vue";
import { ref } from "vue";

let showLogoutModal = ref(false);
</script>
<template>
    <button
        @click="showLogoutModal = true"
        class="hover:scale-105 duration-150 ease-out p-2 text-red-500 mt-3 hover:text-red-600"
    >
        <i class="bi bi-box-arrow-right"></i>
    </button>
    <Teleport to="body">
        <LogoutModal v-if="showLogoutModal" @close="showLogoutModal = false" />
    </Teleport>
</template>
