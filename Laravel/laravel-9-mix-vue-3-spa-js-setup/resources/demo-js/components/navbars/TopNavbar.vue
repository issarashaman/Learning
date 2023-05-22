<template>
<nav class="navbar navbar-expand-lg navbar-dark bg-mix">
  <div class="container-fluid">
    <a class="navbar-brand fs-3 fw-bold" href="/"><i class="fa-brands fa-laravel"></i> {{appName}}</a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">News</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProducts" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Products
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownProducts">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownServices" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Services
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownServices">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">FAQ</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMore" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownMore">
            <li><a class="dropdown-item" href="#">Documentation</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Community</a></li>
            <li><a class="dropdown-item" href="#">Blog</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><RouterLink to="/about" class="dropdown-item">About</RouterLink></li>
          </ul>
        </li>
      </ul>
      <form class="d-lg-none">
        <div class="input-group">
          <input type="search" class="form-control rounded-0 border-0" placeholder="Search" aria-label="Search" aria-describedby="Search">
          <button class="btn btn-light bg-white rounded-0 border-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
      </form>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item d-none d-lg-inline me-2">
          <ModalSearch />
        </li>
        <LanguageDropdown />
        <template v-if="!$auth.loggedIn">
        <li class="nav-item mt-3 mt-lg-0 ms-2">
          <RouterLink to="/accounts/login" class="btn btn-outline-light rounded-0 d-md-block w-100" aria-current="page">Sign in</RouterLink>
        </li>
        <li class="nav-item mt-3 mt-lg-0 ms-2 d-lg-none d-xl-inline">
          <RouterLink to="/accounts/register" class="btn btn-light rounded-0 d-md-block w-100">Create account</RouterLink>
        </li>
        </template>
        <template v-if="$auth.loggedIn">
        <li class="nav-item dropdown mb-3 mb-lg-0 ms-2">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="@/assets/img/avatars/Author-Wumpus-Webflow.png" alt="mdo" width="32" height="32" class="rounded-circle">
            <span class="text-light ms-2">{{ $auth.currentUser.name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><RouterLink to="/console" class="dropdown-item">Console</RouterLink></li>
            <li><RouterLink to="/settings" class="dropdown-item">Settings</RouterLink></li>
            <li><hr class="dropdown-divider"></li>
            <li><a href="#" class="dropdown-item" @click="logOut">Sign out</a></li>
          </ul>
        </li>
        </template>
      </ul>
    </div>
  </div>
</nav>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "@/stores/authStore";
import LanguageDropdown from "./LanguageDropdown.vue";
import ModalSearch from "../modals/ModalSearch.vue";

const appName = ref(window.configs["appName"]);

const auth = useAuthStore();

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

<style lang="scss" scoped>

</style>