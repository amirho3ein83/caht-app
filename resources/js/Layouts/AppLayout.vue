<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "@/Components/ApplicationMark.vue";
import JetBanner from "@/Components/Banner.vue";
import JetDropdown from "@/Components/Dropdown.vue";
import JetDropdownLink from "@/Components/DropdownLink.vue";
import JetNavLink from "@/Components/NavLink.vue";
import JetResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import Navbar from "../Pages/Chat/Navbar.vue";
import MessageContainer from "../Pages/Chat/MessageContainer.vue";

defineProps({
    title: String,
    name: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    Inertia.put(
        route("current-team.update"),
        {
            team_id: team.id,
        },
        {
            preserveState: false,
        }
    );
};

const logout = () => {
    Inertia.post(route("logout"));
};
</script>

<template>
    <Head>
        <title>Seekingon</title>
        <link
            rel="icon"
            type="image/svg+xml"
            href="https://previews.123rf.com/images/phys1cx/phys1cx1605/phys1cx160500020/56618445-chat-app-icon-template-mobile-application-icon-vector-colorful-photo-icon.jpg"
        />
    </Head>
    <div>
        <main
            class="bg-gradient-to-r from-gray-700 to-gray-900 flex mx-auto justify-center"
        >
            <Navbar />
            <!-- <div class="sticky left-0 z-40 h-screen " >

            </div> -->
            <aside class="main mx-4 my-0 py-3 w-[420px] h-screen sticky overflow-y-auto overflow-x-hidden top-0">
                <slot />
            </aside>
            <MessageContainer class="flex-1"/>
        </main>
    </div>
</template>
