import { useAuthStore } from "../../stores/authStore";

const redirectToHomeOnLoggedIn = (to, from, next) => {
  if (useAuthStore().loggedIn) next({ name: "page-home" });
  else next();
};

const authRoutes = [
  {
    path: "/login",
    redirect: "/accounts/login",
    meta: { requireVerify: true },
  },
  {
    path: "/accounts/register",
    name: "auth-register",
    component: () => import("../../views/accounts/AuthRegister.vue"),
    meta: { layout: "layout-auth" },
    beforeEnter: redirectToHomeOnLoggedIn,
  },
  {
    path: "/accounts/login",
    name: "auth-login",
    component: () => import("../../views/accounts/AuthLogin.vue"),
    meta: { layout: "layout-auth" },
    beforeEnter: redirectToHomeOnLoggedIn,
  },
  {
    path: "/accounts/verify-email/:id/:hash?",
    alias: "/verify-email/:id/:hash?",
    name: "auth-verify-email",
    component: () => import("../../views/accounts/AuthVerifyEmail.vue"),
    meta: { layout: "layout-error", requireVerify: true },
  },
  {
    path: "/accounts/resend-verification-email",
    name: "auth-resend-verification-email",
    component: () => import("../../views/accounts/AuthResendVerificationEmail.vue"),
    meta: { layout: "layout-error" },
  },
  {
    path: "/accounts/forgot-password",
    name: "auth-forgot-password",
    component: () => import("../../views/accounts/AuthForgotPassword.vue"),
    meta: { layout: "layout-auth" },
    //beforeEnter: redirectToHomeOnLoggedIn,
  },
  {
    path: "/accounts/reset-password/:token?",
    name: "auth-reset-password",
    alias: "/password-reset/:token?",
    component: () => import("../../views/accounts/AuthResetPassword.vue"),
    meta: { layout: "layout-auth" },
    //beforeEnter: redirectToHomeOnLoggedIn,
  },
  {
    path: "/settings",
    component: () => import("../../views/accounts/settings/SettingView.vue"),
    meta: { requireAuth: true },
    children: [
      // UserHome will be rendered inside User's <router-view>
      // when /users/:username is matched
      { path: "", component: () => import("../../views/accounts/settings/SettingHome.vue") },

      // UserProfile will be rendered inside User's <router-view>
      // when /users/:username/profile is matched
      { path: "profile", component: () => import("../../views/accounts/settings/SettingProfile.vue"), },

      // UserPosts will be rendered inside User's <router-view>
      // when /users/:username/posts is matched
      { path: "password", component: () => import("../../views/accounts/settings/SettingPassword.vue") },
    ],
  },
];

export default authRoutes;
