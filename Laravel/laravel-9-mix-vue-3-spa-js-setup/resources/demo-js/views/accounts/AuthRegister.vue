<template>
  <div class="modal-content rounded-4 shadow">
    <div class="modal-header p-5 pb-4 border-bottom-0">
      <!-- <h5 class="modal-title">Modal title</h5> -->
      <h2 class="fw-bold mb-0">Sign up for free</h2>
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
      <form @submit.prevent="emailSignUp">
        <div class="form-floating mb-3">
          <input v-model="name" type="text" class="form-control rounded-3" :class="errors.name ? 'is-invalid' : ''" id="name" placeholder="Your name" />
          <label for="name">Your name</label>
          <div v-if="errors.name" id="name" class="invalid-feedback">
            {{ errors.name.toString() }}
          </div>
        </div>
        <div class="form-floating mb-3">
          <input v-model="email" type="email" class="form-control rounded-3" :class="errors.email ? 'is-invalid' : ''" id="email" placeholder="name@example.com" />
          <label for="email">Email address</label>
          <div v-if="errors.email" id="email" class="invalid-feedback">
            {{ errors.email.toString() }}
          </div>
        </div>
        <div class="form-floating mb-3">
          <input v-model="password" type="password" class="form-control rounded-3" :class="errors.password ? 'is-invalid' : ''" id="password" placeholder="Password" />
          <label for="password">Password</label>
          <div v-if="errors.password" class="invalid-feedback">
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
          <div v-if="errors.password_confirmation" class="invalid-feedback">
            {{ errors.password_confirmation.toString() }}
          </div>
        </div>
        <small class="text-muted">By clicking Create account, you agree to the terms of use.</small>
        <button class="w-100 mt-2 btn btn-lg rounded-3 btn-primary" type="submit" :disabled="!name || !email || !password || !password_confirmation">
          <div v-if="loading" class="spinner-border mx-3 spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <span v-else>Create an account</span>
        </button>
        <RouterLink to="/accounts/login" class="w-100 mt-2 btn btn-lg rounded-3 btn-outline-dark" type="button">Already have an account?</RouterLink>
        <hr class="my-4" />
        <h2 class="text-center fs-5 mb-3">Or use a third-party</h2>
        <button class="w-100 py-2 mb-2 btn btn-info text-light rounded-3" type="button">
          <svg class="bi me-1" width="16" height="16"><use xlink:href="#twitter" /></svg>
          Sign up with Twitter
        </button>
        <button class="w-100 py-2 mb-2 btn btn-primary rounded-3" type="button">
          <svg class="bi me-1" width="16" height="16"><use xlink:href="#facebook" /></svg>
          Sign up with Facebook
        </button>
        <button class="w-100 py-2 mb-2 btn btn-dark rounded-3" type="button">
          <svg class="bi me-1" width="16" height="16"><use xlink:href="#github" /></svg>
          Sign up with GitHub
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "../../stores/authStore";
import { getCurrentInstance } from "vue";

const auth = useAuthStore();

const internalInstance = getCurrentInstance();

const name = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");
const message = ref();
const errors = ref({});
const loading = ref(false);

function emailSignUp() {
  internalInstance.appContext.config.globalProperties.$Progress.start();
  loading.value = !loading.value;

  auth
    .createUserWithEmailAndPassword(name.value, email.value, password.value, password_confirmation.value)
    .then(function (response) {
      internalInstance.appContext.config.globalProperties.$Progress.finish();
      // handle success
      console.log(response);
      window.location.reload(true);
    })
    .catch(function (error) {
      internalInstance.appContext.config.globalProperties.$Progress.fail();
      // handle error
      console.log(error.response.data.message);
      console.log(error.response.data.errors);
      message.value = error.response.data.message;
      errors.value = error.response.data.errors;
      loading.value = !loading.value;
    });
}
</script>
