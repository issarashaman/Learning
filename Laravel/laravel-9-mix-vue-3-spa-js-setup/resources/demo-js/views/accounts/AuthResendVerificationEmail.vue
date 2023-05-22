<template>
  <div v-if="loading" class="col text-center text-light">
    <div class="spinner-border" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
    <div class="lead">Please wait...</div>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref, getCurrentInstance } from "vue";
import { useAuthStore } from "@/stores/authStore";
import Swal from "sweetalert2";

const auth = useAuthStore();

const internalInstance = getCurrentInstance();

const loading = ref(false);

const verify_to_url = localStorage.getItem("verify_to_url");

if (verify_to_url) {
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
} else {
  Swal.fire({
    icon: "error",
    title: "Verify Email",
    text: "Your email address is not verified.",
    showDenyButton: true,
    confirmButtonText: "Resend Verification Email",
    denyButtonText: "Logout",
    allowEscapeKey: false,
    allowOutsideClick: false,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      internalInstance.appContext.config.globalProperties.$Progress.start();
      loading.value = true;
      // Make a request
      axios
        .post("/email/verification-notification")
        .then(function (response) {
          internalInstance.appContext.config.globalProperties.$Progress.finish();
          loading.value = false;
          // handle success
          console.log(response);
          if (response.data.status == "verification-link-sent") {
            Swal.fire({
              icon: "success",
              title: "Thanks for signing up!",
              text: "A new verification link has been sent to the email address you provided during registration.",
              showConfirmButton: true,
              allowEscapeKey: false,
              allowOutsideClick: false,
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                window.location.href = "/";
              }
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
    } else if (result.isDenied) {
      logOut();
    }
  });
}

function logOut() {
  // Make a request
  auth
    .signOut()
    .then(function (response) {
      // handle success
      console.log(response);
      window.location.href = "/accounts/login";
    })
    .catch(function (error) {
      // handle error
      console.log(error);
    })
    .then(function () {
      // always executed
    });
}
</script>

<style lang="scss" scoped></style>
