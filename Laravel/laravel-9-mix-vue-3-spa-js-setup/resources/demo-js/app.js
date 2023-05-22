import { createApp } from "vue";
import stores from "./stores";
import router from "./router";

import middlewareAuth from "./middleware/auth";

import "./plugins/bootstrap";
import "./plugins/axios";
import i18n from "./plugins/i18n";
import VueProgressBar from "./plugins/vue-progressbar";

const VueProgressBarOptions = {
    canSuccess: true,
    show: false,
    color: "rgb(143, 255, 199)",
    position: "fixed",
    failedColor: "red",
    thickness: "2px",
    transition: {
        speed: "0.2s",
        opacity: "0.6s",
        termination: 300,
    },
    autoRevert: true,
    location: "top",
    inverse: false,
    autoFinish: true
};

//import layouts
import LayoutDefault from "./layouts/LayoutDefault.vue";
import LayoutAuth from "./layouts/LayoutAuth.vue";
import LayoutConsole from "./layouts/LayoutConsole.vue";
import LayoutError from "./layouts/LayoutError.vue";

import App from "./App.vue";

const app = createApp({
    ...App
});

app.use(stores);
app.use(router);
app.use(middlewareAuth);
app.use(VueProgressBar, VueProgressBarOptions);
app.use(i18n);

app.component("layout-default", LayoutDefault);
app.component("layout-auth", LayoutAuth);
app.component("layout-console", LayoutConsole);
app.component("layout-error", LayoutError);

router.isReady().then(() => {
  app.mount("#app");
});

//console.log(app.config);