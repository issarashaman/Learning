import ConsoleView from "../../views/consoles/ConsoleView.vue";

const consoleRoutes = [
  {
    path: "/console",
    alias: "/console/dashboard",
    name: "console-view",
    component: ConsoleView,
    meta: { layout: "layout-console", requireAuth: true },
  },
];

export default consoleRoutes;
