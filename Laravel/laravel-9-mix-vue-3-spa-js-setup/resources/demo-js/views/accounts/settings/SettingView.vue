<template>
  <main class="settings bg-mix">
    <div class="album py-5 bg-mix">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-3">
            <div class="card shadow-sm p-4">
              <h3>Settings</h3>
              <ul class="nav flex-column">
                <li class="nav-item">
                  <RouterLink to="/settings" class="nav-link link-dark">General</RouterLink>
                </li>
                <li class="nav-item">
                  <RouterLink to="/settings/profile" class="nav-link link-dark">Profile</RouterLink>
                </li>
                <li class="nav-item">
                  <RouterLink to="/settings/password" class="nav-link link-dark">Password</RouterLink>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-12 col-lg-9 mt-4 mt-lg-0">
            <router-view></router-view>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
</script>

<style lang="scss" scoped>
.settings {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  height: 100vh;
  padding-top: 10px;
}
</style>