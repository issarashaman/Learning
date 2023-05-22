<template>
  <div id="layout-console">
    <TopNavbar />
    <div id="dashboard" class="dashboard container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar">
          <div class="position-sticky">
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <a class="link-dark text-decoration-none" href="/console/dashboard">
                  <h1 class="text-center fw-bold p-2" id="headingOne">Console</h1>
                </a>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Projects
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body bg-light">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="#">Project 101</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Project 102</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Project 103</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo"
                    aria-expanded="false"
                    aria-controls="collapseTwo"
                  >
                    Tools
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body bg-light">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="#">Todo 1</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Todo 2</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Todo 3</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseThree"
                    aria-expanded="false"
                    aria-controls="collapseThree"
                  >
                    Support
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="accordion-body bg-light">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="#">Community</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">FAQ</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Documentation</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>

        <slot />
      </div>
    </div>

    <footer class="footer fixed-bottom mt-auto py-2 py-lg-4 bg-white shadow-lg small">
      <div class="d-flex flex-wrap justify-content-center align-items-center px-3">
        <div class="col-lg-6 d-flex flex-column text-center text-lg-start">
          <span class="text-muted">&copy; 2022 CODE Developers, Inc. All rights reserved.</span>
        </div>

        <ul class="nav col-md-6 d-flex justify-content-end list-unstyled text-center text-lg-end">
          <li class="ms-0"><a class="text-muted" href="#">About CODE Developers site</a></li>
          <li class="ms-3">
            <div class="vr"></div>
          </li>
          <li class="ms-3"><a class="text-muted" href="#">Terms and Policies</a></li>
        </ul>
      </div>
    </footer>
  </div>
</template>

<script setup>
import TopNavbar from "../components/navbars/TopNavbar.vue";
</script>

<style lang="scss">
body {
  font-size: .875rem;
}

.dashboard {
  min-height: 100%;
  padding-top: 0;
  padding-bottom: 4rem;
}

.feather {
  width: 16px;
  height: 16px;
  vertical-align: text-bottom;
}

/*
 * Sidebar
 */
.sidebar {
  top: 0;
  /* rtl:raw:
  right: 0;
  */
  bottom: 0;
  /* rtl:remove */
  left: 0;
  z-index: 100;
  /* Behind the navbar */
  padding: 0px 0 0;
  /* Height of navbar */
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: .5rem;
  overflow-x: hidden;
  overflow-y: auto;
  /* Scrollable contents if viewport is shorter than content. */
}

.sidebar .nav-link {
  font-weight: 400;
  color: #333;
}

.sidebar .nav-link.active {
  color: #000;
}

.sidebar-heading {
  font-size: .75rem;
  text-transform: uppercase;
}

.accordion-button {
  background-color: #fff;
}

.accordion-button:not(.collapsed) {
  color: #000;
  background-color: #fff;
  box-shadow: inset 0 -1px 0 rgb(0 0 0 / 13%);
  font-weight: bold;
}
</style>
