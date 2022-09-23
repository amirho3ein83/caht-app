<script setup>


import AppLayout from "@/Layouts/AppLayout.vue";
import ChatItem from "./ChatItem.vue";
import MessageItem from "./MessageItem.vue";
import { Link } from "@inertiajs/inertia-vue3";

import MessageContainer from "./MessageContainer.vue";
import Navbar from "./Navbar.vue";
import ContactBio from "./ContactBio.vue";
import Sidebar from "./Sidebar.vue";

</script> 

<template>
    <AppLayout>
        <div class="flex mx-auto justify-center">
            <!-- This is an example component -->
            <Sidebar/>

                <MessageContainer />
        </div>
    </AppLayout>
</template>
