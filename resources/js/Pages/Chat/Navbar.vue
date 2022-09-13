


<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { ref } from "vue";
import ExploreAccounts from "./ExploreAccounts.vue";
import NewBroadCast from "./NewBroadCast.vue";


let logout = () => {
  axios.post(route("logout"));
};

let showExploreAccounts = ref(false);


let showBroadCastForm = ref(false);
const toggleBroadCastForm = () => {
  showBroadCastForm.value = !showBroadCastForm.value;
};
</script>
            

<template>
  <div class="pb-2 relative flex px-2 justify-between">
    <ExploreAccounts v-if="showExploreAccounts" v-on:modalClosed="showExploreAccounts =false" />

    <NewBroadCast v-if="showBroadCastForm" v-on:broadcastStarted="toggleBroadCastForm()" />

    <img @click="$emit('closeBioPage')" class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile"
      :alt="$page.props.user.username" />

    <!-- Settings Dropdown -->
    <div class="relative flex">

      <button @click="showExploreAccounts = !showExploreAccounts" class="px-4 py-2 text-gray-400 hover:text-gray-300">
        <i style="font-size: 28px" class="bi bi-person-plus-fill"></i>
      </button>

      <button @click="toggleBroadCastForm()" class="px-4 py-2 text-gray-400 hover:text-gray-300">
        <i class="bi bi-broadcast-pin"></i>
      </button>

      <button class="px-4 py-2 text-gray-400 hover:text-gray-300">
        <i class="bi bi-chat-left-dots"></i>
      </button>

      <Dropdown align="right" width="48">
        <template #trigger>
          <i class="mr-4 bi bi-three-dots-vertical text-gray-200" style="font-size: 20px"></i>

        </template>

        <template #content>
          <!-- Account Management -->
          <!-- <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Manage Account
                                </div> -->

          <DropdownLink :href="route('profile.show')">
            <div class="flex justify-between">
              Profile
              <i class="bi bi-person-circle" style="font-size: 22px"></i>
            </div>
          </DropdownLink>

          <!-- <div class="border-t border-gray-100" /> -->

          <!-- Authentication -->
          <form @submit="logout">
            <DropdownLink>
              <div class="flex justify-between">
                Logout
                <i class="text-red-600 bi bi-box-arrow-right" style="font-size: 22px"></i>
              </div>
            </DropdownLink>
          </form>
        </template>
      </Dropdown>

    </div>

  </div>
</template>


