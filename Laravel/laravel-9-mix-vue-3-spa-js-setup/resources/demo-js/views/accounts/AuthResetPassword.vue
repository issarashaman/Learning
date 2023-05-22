<template>
  <div class="modal-content rounded-4 shadow">
    <div class="modal-header p-5 pb-4 border-bottom-0">
      <!-- <h5 class="modal-title">Modal title</h5> -->
      <h2 class="fw-bold mb-0">Reset Password</h2>
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
        <div class="form-floating mb-3">
          <input v-model="email" type="hidden" class="form-control rounded-3" id="email" placeholder="name@example.com" />
          <label for="email">Email address</label>
        </div>
        <div class="form-floating mb-3">
          <input v-model="password" type="password" class="form-control rounded-3" :class="errors.password ? 'is-invalid' : ''" id="password" placeholder="Password" />
          <label for="password">Password</label>
          <div v-if="errors.password" class="invalid-feedback fw-bold">
            {{ errors.password.toString() }}
          </div>
        </div>
        <div class="form-floating mb-3">
          <input
            v-model="password_confirmation"
            type="password"
            class="form-control rounded-3"
            :class="errors.password_confirmation ? 'is-invalid' : ''"
            id="password_confirmation"
            placeholder="Confirm Password"
          />
          <label for="password_confirmation">Confirm Password</label>
          <div v-if="errors.password_confirmation" class="invalid-feedback fw-bold">
            {{ errors.password_confirmation.toString() }}
          </div>
        </div>
        <button class="w-100 mt-2 btn btn-lg rounded-4 btn-primary" type="submit" :disabled="!password || !password_confirmation">
          <div v-if="loading" class="spinner-border mx-3 spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <span v-else>Reset Password</span>
        </button>
        <hr class="my-4" />
      </form>
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref, getCurrentInstance } from "vue";
import { useRoute } from "vue-router";
import Swal from "sweetalert2";

const route = useRoute();

console.log(route.params.token);

const internalInstance = getCurrentInstance();

const email = ref(route.query.email);
const password = ref("");
const password_confirmation = ref("");
const message = ref();
const errors = ref({});
const loading = ref(false);

function resetPassword() {
  internalInstance.appContext.config.globalProperties.$Progress.start();
  loading.value = !loading.value;
  // Make a request
  axios
    .post("/reset-password", {
      token: route.params.token,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
    })
    .then(function (response) {
      internalInstance.appContext.config.globalProperties.$Progress.finish();
      // handle success
      console.log(response);
      Swal.fire({
        text: "Your password has been updated!",
        icon: "success",
      }).then(() => {
        window.location.href = "/accounts/login";
      });
    })
    .catch(function (error) {
      internalInstance.appContext.config.globalProperties.$Progress.fail();
      loading.value = !loading.value;
      // handle error
      console.log(error.response.data.message);
      console.log(error.response.data.errors);
      message.value = error.response.data.message;
      errors.value = error.response.data.errors;
    })
    .then(function () {
      // always executed
    });
}
</script>
