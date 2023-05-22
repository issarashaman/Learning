<template>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ project_name }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><router-link to="/console">Console</router-link></li>
            <li class="breadcrumb-item active">{{ project_name }}</li>
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
          <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="/console/project/{{this.$router.params.id}}/settings" data-source-selector="#card-refresh-content">
            <i class="fas fa-sync-alt"></i>
          </button>
          <button type="button" class="btn btn-tool" @click="this.$router.push('/console/project/' + project_id + '/settings')">
            <i class="fas fa-cogs"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <h3>Basic information</h3>
        <div class="form-group row">
          <label for="staticProject" class="col-lg-3 col-form-label">Project name</label>
          <div class="col-lg-9">
            <input v-model="project_name" type="text" class="form-control" :class="errors.project_name ? 'is-invalid' : ''" id="project_name" disabled />
          </div>
        </div>
        <div class="form-group row">
          <label for="staticProject" class="col-lg-3 col-form-label">Project description</label>
          <div class="col-lg-9">
            <textarea v-model="project_description" id="project_description" class="form-control" :class="errors.project_description ? 'is-invalid' : ''" rows="3" disabled></textarea>
          </div>
        </div>
        <div class="form-group row d-flex align-items-center">
          <label for="staticProject" class="col-lg-3 col-form-label">Project Progress</label>
          <div class="col-lg-9">
            <div class="progress">
              <div class="progress-bar" id="project_progress" role="progressbar" :style="{ width: project_progress + '%' }" aria-valuenow="{{ project_progress }}" aria-valuemin="0" aria-valuemax="100">
                <span class="mx-1">Progress {{ project_progress }}%</span>>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row d-flex align-items-center">
          <label for="staticProject" class="col-lg-3 col-form-label">Project Status</label>
          <div class="col-lg-9">
            <span class="badge badge-success">{{ project_status }}</span>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer mb-4">
        <p>A provider is an individual developer, company, or organization that provides services. For more details, see the <a href="/docs">document</a></p>
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
import { useRoute } from "vue-router";

const route = useRoute();

const project_id = ref("");
const project_name = ref("");
const project_description = ref("");
const project_progress = ref(0);
const project_status = ref("");

const successMessage = ref("");
const errorMessage = ref("");
const errors = ref({});

const loading = ref(false);

// Make a request for a user with a given ID
axios
  .get("/api/projects/" + route.params.id)
  .then(function (response) {
    // handle success
    console.log(response);
    project_id.value = response.data.project_id;
    project_name.value = response.data.project_name;
    project_description.value = response.data.project_description;
    project_progress.value = response.data.project_progress;
    project_status.value = response.data.project_status;
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .then(function () {
    // always executed
  });
</script>

<style lang="scss" scoped></style>
