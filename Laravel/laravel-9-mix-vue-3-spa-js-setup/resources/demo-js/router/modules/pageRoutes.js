import HomeView from "../../views/pages/HomeView.vue";

const pageRoutes = [
  {
    path: "/",
    name: "page-home",
    component: HomeView,
    alias: "/home",
  },
  {
    path: "/about",
    name: "page-about",
    // route level code-splitting
    // this generates a separate chunk (About.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import("../../views/pages/AboutView.vue")
  },
];

export default pageRoutes;
