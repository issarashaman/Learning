import { createRouter, createWebHistory } from "vue-router";
import routes from "./routes";
import { useAuthStore } from "../stores/authStore";

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  if (to.meta.requireAuth && !useAuthStore().loggedIn)
      next({ name: "auth-login" });
  else next();
});

router.beforeEach((to, from, next) => {
  if (to.meta.requireVerify) {
    localStorage.setItem("verify_to_url", "" + to.fullPath);
    next();
  }
  else next();
});

export default router;
