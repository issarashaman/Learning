<template>
  <div></div>
</template>

<script setup>
import Swal from "sweetalert2";
import { useRouter } from "vue-router";
import { getCurrentInstance } from "vue";

const router = useRouter();

const internalInstance = getCurrentInstance();

internalInstance.appContext.config.globalProperties.$Progress.fail();

Swal.fire({
  title: "Page Not Found",
  text: "Sorry, the webpage may be corrupted or URL is invalid.",
  icon: "error",
  confirmButtonText: "Back to Home",
  grow: "fullscreen",
  padding: 0,
  allowEscapeKey: false,
  allowOutsideClick: false,
}).then(() => {
  router.push({ path: "/" });
});
</script>

<style lang="scss" scoped>
</style>