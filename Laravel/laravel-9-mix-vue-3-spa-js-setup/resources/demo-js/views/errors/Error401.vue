<template>
  <div></div>
</template>

<script setup>
import Swal from "sweetalert2";
import { getCurrentInstance } from "vue";

const internalInstance = getCurrentInstance();

internalInstance.appContext.config.globalProperties.$Progress.fail();

Swal.fire({
  title: "Session Expired!",
  text: "Please log in again to continue.",
  icon: "warning",
  confirmButtonText: "Ok",
  allowEscapeKey: false,
  allowOutsideClick: false,
}).then(() => {
  localStorage.removeItem("isLoggedin");
  document.cookie = "laravel_mix_spa_session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  document.cookie = "XSRF-TOKEN=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  window.location.href = "/accounts/login";
});
</script>

<style lang="scss" scoped></style>
