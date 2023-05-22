const errorRoutes = [
  {
    path: "/error/500",
    name: "error-500",
    // route level code-splitting
    // this generates a separate chunk (About.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import("../../views/errors/Error500.vue"),
    meta: { layout: "layout-error" },
  },
  {
    path: "/error/401",
    name: "error-401",
    // route level code-splitting
    // this generates a separate chunk (About.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import("../../views/errors/Error401.vue"),
    meta: { layout: "layout-error" },
  },
  {
    path: "/:pathMatch(.*)*",
    name: "error-404",
    // route level code-splitting
    // this generates a separate chunk (About.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import("../../views/errors/Error404.vue"),
    meta: { layout: "layout-error" },
  },
];

export default errorRoutes;
