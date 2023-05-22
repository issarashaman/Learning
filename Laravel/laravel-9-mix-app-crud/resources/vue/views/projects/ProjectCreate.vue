<template>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create a new Project</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/console">Console</a></li>
            <li class="breadcrumb-item active">Create a new Project</li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card card-primary card-outline">
      <div class="card-header border-0">
        <h3 class="card-title">Project information</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" @click="this.$router.go(-1)">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <h3>Basic information</h3>
        <div class="form-group row">
          <label for="staticProject" class="col-lg-3 col-form-label">Project name</label>
          <div class="col-lg-9">
            <input v-model="project_name" type="text" class="form-control" :class="errors.project_name ? 'is-invalid' : ''" id="project_name" />
            <div v-if="errors.project_name" id="project_name" class="invalid-feedback">
              {{ errors.project_name.toString() }}
            </div>
            <small class="form-text text-muted">Don't leave this empty</small>
            <small class="form-text text-muted">Don't use special characters (4-byte Unicode)</small>
            <small class="form-text text-muted">Enter no more than 100 characters</small>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticProject" class="col-lg-3 col-form-label">Project description</label>
          <div class="col-lg-9">
            <textarea v-model="project_description" id="project_description" class="form-control" :class="errors.project_description ? 'is-invalid' : ''" rows="3"></textarea>
            <div v-if="errors.project_description" id="project_description" class="invalid-feedback">
              {{ errors.project_description.toString() }}
            </div>
            <small class="form-text text-muted">(Optional)</small>
            <small class="form-text text-muted">Enter no more than 255 characters</small>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer mb-4">
        <p>A provider is an individual developer, company, or organization that provides services. For more details, see the <a href="/docs">document</a></p>
        <button type="button" class="btn btn-primary" @click="useProjectCreate">Create</button>
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const project_name = ref("");
const project_description = ref("");

const successMessage = ref("");
const errorMessage = ref("");
const errors = ref({});

const loading = ref(false);

function useProjectCreate() {
  loading.value = !loading.value;
  // Make a request for a user with a given ID
  axios
    .post("/api/projects", {
      project_name: project_name.value,
      project_description: project_description.value,
    })
    .then(function (response) {
      // handle success
      console.log(response);
      loading.value = !loading.value;
      console.log(response.data.project_id);
      window.location.href = "/console/project/"+response.data.project_id;
    })
    .catch(function (error) {
      // handle error
      console.log(error.response.data);
      loading.value = !loading.value;
      errorMessage.value = error.response.data.message;
      errors.value = error.response.data.errors;
    })
    .then(function () {
      // always executed
    });
}
</script>

<style lang="scss" scoped></style>
