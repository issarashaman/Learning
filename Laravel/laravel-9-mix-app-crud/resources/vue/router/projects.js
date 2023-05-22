
const projects = [
  {
    path: "/console/project/create",
    name: "project-create",
    component: () => import("../views/projects/ProjectCreate.vue"),
  },
  {
    path: "/console/project/:id",
    name: "project-view",
    component: () => import("../views/projects/ProjectView.vue"),
  },
  {
    path: "/console/project/:id/settings",
    name: "project-settings",
    component: () => import("../views/projects/ProjectEdit.vue"),
  },
];

export default projects;
