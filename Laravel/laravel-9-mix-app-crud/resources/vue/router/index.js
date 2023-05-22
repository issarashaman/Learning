import { createRouter, createWebHistory } from 'vue-router'

import ConsoleView from '../views/ConsoleView.vue'

import projects from './projects'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/console',
      name: 'console',
      component: ConsoleView
    },
    ...projects
  ],
  linkExactActiveClass: "active"
})

export default router
