import './bootstrap';

import { createApp } from "vue/dist/vue.esm-bundler.js";

import WelcomeComponent from "./components/WelcomeComponent.vue";

const app = createApp({
  /* root component options */
});

app.component("welcome-component", WelcomeComponent);

app.mount("#app");
