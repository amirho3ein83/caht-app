import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import axios from "axios";
import Echo from "laravel-echo";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .component("Link", Link)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4B5563" });

// const message_el = window.document.getElementById("messages");
// const username_input = window.document.getElementById("username_input");
// const message_input = window.document.getElementById("message_input");
// const message_form = window.document.getElementById("message_form");
// // window.alert(message_form)

// message_form.addEventListener("submit", function (e) {
//     e.preventDefault();

//     let has_error = false;

//     if (username_input.value == "") {
//         alert("Please enter a username");
//         has_error = true;
//     }
//     if (message_input.value == "") {
//         alert("Please enter a message");
//         has_error = true;
//     }
//     if (has_error) {
//         return;
//     }

//     const options = {
//         method: "post",
//         url: "/send-message",
//         data: {
//             username: username_input.value,
//             message: message_input.value,
//         },
//     };

//     axios(options);
// });

// window.Echo.channel("chat").listen(".message", (e) => {

//     message_el.innerHTML += '<div><strong>'+e.username+'</strong>'+e.message+'</div>'
// });
