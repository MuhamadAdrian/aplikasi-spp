require("./bootstrap");

// Import modules...
import { createApp, h } from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin,
} from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import VueApexCharts from "vue3-apexcharts";

const el = document.getElementById("app");

const app = createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
});

app.mixin({ methods: { route } }).use(InertiaPlugin).mount(el);

app.use(VueApexCharts);

InertiaProgress.init({ color: "#6666EE" });
