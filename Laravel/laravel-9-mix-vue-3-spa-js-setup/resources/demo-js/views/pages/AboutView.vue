<template>
  <div class="about">
      <HelloWorld laravel="Laravel 9.11.0" vue="Vue 3.2.33" bootstrap="Bootstrap 5.2.0-beta1" fontawesome="Fontawesome 6.1.1" sweetalert2="Sweetalert2 11.4.14" />
  </div>
</template>

<script setup>
import HelloWorld from "../../components/HelloWorld.vue";
import Swal from "sweetalert2";

Swal.fire({
  title: "<strong>Laravel <u>example</u></strong>",
  icon: "info",
  html:
    "You can use <b>bold text</b>, " +
    "<a href=\"//sweetalert2.github.io\">links</a> " +
    "and other HTML tags",
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    "<i class=\"fa fa-thumbs-up\"></i> Great!",
  confirmButtonAriaLabel: "Thumbs up, great!",
  cancelButtonText:
    "<i class=\"fa fa-thumbs-down\"></i>",
  cancelButtonAriaLabel: "Thumbs down"
});
</script>