<template>
  <div class="card bg-mix text-light text-center py-4 border-0 rounded-0">
    <RouterLink to="/" class="link-light text-decoration-none h1 display-1 mb-4 pb-4">Laravel Mix SPA</RouterLink>
    <h1 class="mb-4"><i class="fa-brands fa-laravel"></i> {{ laravel }}</h1>
    <h1 class="mb-4"><i class="fa-brands fa-vuejs"></i> {{ vue }}</h1>
    <h1 class="mb-4"><i class="fa-brands fa-bootstrap"></i> {{ bootstrap }}</h1>
    <h1 class="mb-4"><i class="fa-solid fa-font-awesome"></i> {{ fontawesome }}</h1>
    <h1 class="mb-4"><i class="fa-solid fa-bell"></i> {{ sweetalert2 }}</h1>
  </div>
</template>

<script setup>
defineProps({
  laravel: String,
  vue: String,
  bootstrap: String,
  fontawesome: String,
  sweetalert2: String,
});
</script>
