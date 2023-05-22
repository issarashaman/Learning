<template>
  <div class="modal-content rounded-4 shadow">
    <div class="modal-header p-5 pb-4 border-bottom-0">
      <!-- <h5 class="modal-title">Modal title</h5> -->
      <h2 class="fw-bold mb-0">Forgot Password?</h2>
      <RouterLink to="/" class="btn-close"></RouterLink>
    </div>

    <div class="modal-body p-5 pt-0">
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
          No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>
        <div class="form-floating mb-3">
          <input
            v-model="email"
            type="email"
            class="form-control rounded-3"
            :class="errors.email ? 'is-invalid' : ''"
            id="email"
            placeholder="name@example.com"
            :disabled="loading"
          />
          <label for="email">Email address</label>
          <div v-if="errors.email" id="email" class="invalid-feedback fw-bold">
            {{ errors.email.toString() }}
          </div>
        </div>
        <button class="w-100 mt-2 btn btn-lg rounded-3 btn-primary" type="submit" :disabled="!email">
          <div v-if="loading" class="spinner-border mx-3 spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <span v-else>Send Password Reset Link</span>
        </button>
        <hr class="my-4" />
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import { getCurrentInstance } from "vue";
import Swal from "sweetalert2";

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
    .post("/forgot-password", {
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
        window.location.href = "/accounts/login";
      });
    })
    .catch(function (error) {
      internalInstance.appContext.config.globalProperties.$Progress.fail();
      // handle error
      //console.log(error.response.data.message);
      //console.log(error.response.data.errors);
      message.value = error.response.data.message;
      errors.value = error.response.data.errors;
      loading.value = !loading.value;
    })
    .then(function () {
      // always executed
    });
}
</script>
