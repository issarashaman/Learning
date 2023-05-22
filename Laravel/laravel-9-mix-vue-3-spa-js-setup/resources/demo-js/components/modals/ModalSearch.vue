<template>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-link link-light" data-bs-toggle="modal" data-bs-target="#searchModal">
    <i class="fa-solid fa-magnifying-glass"></i>
  </button>

  <!-- Modal -->
  <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-4 shadow">
        <div class="modal-header p-5 pb-4 border-bottom-0">
          <!-- <h5 class="modal-title">Modal title</h5> -->
          <h2 class="fw-bold mb-0">Search</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body p-5 pt-0">
          <form>
            <div class="input-group">
              <input type="search" class="form-control form-control-lg bg-light rounded-0 border-0" list="datalistOptions" placeholder="Type to search..." aria-label="Search" aria-describedby="Search" />
              <datalist id="datalistOptions">
                <option value="San Francisco"></option>
                <option value="New York"></option>
                <option value="Seattle"></option>
                <option value="Los Angeles"></option>
                <option value="Chicago"></option>
              </datalist>
              <button class="btn btn-light rounded-0 border-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup></script>

<style lang="scss" scoped></style>
