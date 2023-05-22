import { useAuthStore } from "../stores/authStore";

export default {
  install: ({ config }) => {
    config.globalProperties.$auth = useAuthStore();

    if (useAuthStore().loggedIn) {
      useAuthStore().ftechUser();
    }
  },
};
