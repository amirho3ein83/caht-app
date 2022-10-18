import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

import { createPinia } from "pinia";
import "bootstrap-icons/font/bootstrap-icons.css";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Seekingon";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(createPinia())
            .use(plugin)
            .component("Link", Link)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4B5563" });

// Echo.private(`orders.${orderId}`)
//     .listen('OrderShipmentStatusUpdated', (e) => {
//         console.log(e.order);
//     });