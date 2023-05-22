<template>
  <div class="card shadow bg-white">
    <div class="p-5 pb-4">
      <h2 class="fw-bold mb-0">General Settings</h2>
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
      <form>
        <button type="button" class="btn btn-danger w-100 mt-4" @click="logOut">Sign out</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "@/stores/authStore";

const message = ref();

const auth = useAuthStore();

//const { isLoggedin, userCredential } = storeToRefs(auth);

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
