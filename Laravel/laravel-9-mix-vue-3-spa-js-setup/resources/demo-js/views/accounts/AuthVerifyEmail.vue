<template>
  <div></div>
</template>

<script setup>
import axios from "axios";
import { ref, getCurrentInstance } from "vue";
import Swal from "sweetalert2";

const internalInstance = getCurrentInstance();

const verify_to_url = localStorage.getItem("verify_to_url");

const loading = ref(false);

internalInstance.appContext.config.globalProperties.$Progress.start();
loading.value = true;
// Make a request
  axios
    .post(verify_to_url)
    .then(function (response) {
      internalInstance.appContext.config.globalProperties.$Progress.finish();
      loading.value = false;
      // handle success
      console.log(response);
      if (response.statusText == "OK") {
        Swal.fire({
          icon: "success",
          title: "Thanks for sign up!",
          text: "Your email has been verify.",
          showConfirmButton: false,
          timer: 3000,
        }).then(() => {
          localStorage.removeItem("verify_to_url");
          window.location.href = "/?verified=1";
        });
      }
    })
    .catch(function (error) {
      internalInstance.appContext.config.globalProperties.$Progress.fail();
      loading.value = false;
      // handle error
      console.log(error);
    })
    .then(function () {
      // always executed
    });
</script>

<style lang="scss" scoped>
</style>