<template>
  <div id="layout-auth" class="bg-mix">
    <div class="modal modal-auth position-static d-block py-5" tabindex="-1" role="dialog" id="modalAuth">
      <div class="modal-dialog" role="document">
        <slot />
      </div>
    </div>
  </div>
</template>

<script setup>

</script>

<style lang="scss">
#modalAuth {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  height: 100vh;
  padding-top: 40px;
}
</style>