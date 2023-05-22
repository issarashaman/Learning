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
  title: "Oops...",
  text: "Something went wrong! Please try again.",
  icon: "error",
  showConfirmButton: true,
  grow: "fullscreen",
  padding: 0,
  allowEscapeKey: false,
  allowOutsideClick: false,
}).then(() => {
  router.go(-1);
});
</script>

<style lang="scss" scoped>
</style>