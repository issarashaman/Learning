<template>
  <div class="card shadow bg-white">
    <div class="p-5 pb-4">
      <h2 class="fw-bold mb-0">Change Password</h2>
    </div>

    <div class="card-body p-5 pt-0">
      <div v-if="message" class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
          <use xlink:href="#exclamation-triangle-fill" />
        </svg>
        <div>
          {{ message }}
        </div>
      </div>
      <form @submit.prevent="resetPassword">
        <div class="mb-4 text-sm text-gray-600">
          We will email you a password reset link that will allow you to choose a new one.
        </div>
        <div class="form-floating mb-3">
          <input
            v-model="email"
            type="hidden"
            class="form-control rounded-3"
          />
        </div>
        <button class="w-100 mt-2 btn btn-lg rounded-3 btn-primary" type="submit">
          <div v-if="loading" class="spinner-border mx-3 spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <span v-else>Send Password Reset Link</span>
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref, watchEffect, getCurrentInstance } from "vue";
import Swal from "sweetalert2";
import { useAuthStore } from "@/stores/authStore";

const auth = useAuthStore();

const internalInstance = getCurrentInstance();

const email = ref("");
const message = ref();
const errors = ref({});
const loading = ref(false);

function resetPassword() {
  internalInstance.appContext.config.globalProperties.$Progress.start();
  loading.value = !loading.value;
  // Make a request
  axios
    .post("/change-password", {
      email: email.value,
    })
    .then(function (response) {
      internalInstance.appContext.config.globalProperties.$Progress.finish();
      // handle success
      console.log(response);
      Swal.fire({
        text: response.data.status,
        icon: "success",
      }).then(() => {
        window.location.reload(true);
      });
    })
    .catch(function (error) {
      internalInstance.appContext.config.globalProperties.$Progress.fail();
      // handle error
      console.log(error.response.data.message);
      console.log(error.response.data.errors);
      message.value = error.response.data.message;
      errors.value = error.response.data.errors;
      loading.value = !loading.value;
    })
    .then(function () {
      // always executed
    });
}

watchEffect(async () => {
  auth
    .ftechUser()
    .then((response) => {
      //console.log(response);
      email.value = response.email;
    })
    .catch(function (error) {
      // handle error
      console.log(error);
    })
    .then(function () {
      // always executed
    });
});
</script>
