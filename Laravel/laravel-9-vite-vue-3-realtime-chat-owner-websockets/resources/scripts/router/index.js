import { createRouter, createWebHistory } from "vue-router";

import ConsoleView from "../views/ConsoleView.vue";
import chats from "./chats";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/console",
      name: "console",
      component: ConsoleView,
    },
    ...chats,
  ],
});

export default router;
