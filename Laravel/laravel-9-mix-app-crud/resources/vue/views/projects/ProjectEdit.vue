<template>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ project_name }} - Settings</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><router-link to="/console">Console</router-link></li>
            <li class="breadcrumb-item">
              <router-link v-bind:to="'/console/project/'+project_id">{{ project_name }}</router-link>
            </li>
            <li class="breadcrumb-item active">Settings</li>
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
        <h3 class="card-title">Project settings</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="/console/project/{{this.$router.params.id}}" data-source-selector="#card-refresh-content">
            <i class="fas fa-sync-alt"></i>
          </button>
          <button type="button" class="btn btn-tool" @click="this.$router.push('/console/project/'+project_id+'/settings')">
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
        <div class="form-group row d-flex align-items-center">
          <label for="staticProject" class="col-lg-3 col-form-label">Project Progress</label>
          <div class="col-lg-9">
            <div class="progress">
              <div class="progress-bar" id="project_progress" role="progressbar" :style="{ width: project_progress + '%' }" v-bind:aria-valuenow="project_progress" aria-valuemin="0" aria-valuemax="100">
                <span class="mx-1">Progress {{ project_progress }}%</span>
              </div>
            </div>
            <input v-model="project_progress" type="range" class="form-control-range py-2" id="project_progress" min="0" max="100" step="1" />
          </div>
        </div>
        <div class="form-group row d-flex align-items-center">
          <label for="staticProject" class="col-lg-3 col-form-label">Project Status</label>
          <div class="col-lg-9">
            <select v-model="project_status" id="project_status" class="form-control custom-select">
              <option selected disabled>Select one</option>
              <option value="Developing">Developing</option>
              <option value="On Hold">On Hold</option>
              <option value="Canceled">Canceled</option>
              <option value="Success">Success</option>
            </select>
          </div>
        </div>
        <div class="form-group row d-flex align-items-center">
          <label for="staticProject" class="col-lg-3 col-form-label"> </label>
          <div class="col-lg-9">
            <button type="button" class="btn btn-secondary" @click="this.$router.go(-1)">Cancel</button>
            <button type="button" class="btn btn-primary ml-2" @click="useProjectUpdate">Update</button>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer mb-4">
        <h3>Delete this project</h3>
        <p>Only an Admin can delete a project, and only when the project has no channels.</p>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->

  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="deleteModalLabel">Delete this project?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Only an Admin can delete a project, and only when the project has no channels.</p>
        </div>
        <div class="modal-footer border-top-0 p-0">
          <div class="btn-group w-100" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" @click="useProjectDelete">Yes, delete</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRoute } from "vue-router";
import toastr from "toastr";

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

function useProjectUpdate() {
  loading.value = !loading.value;
  // Make a request for a user with a given ID
  axios
    .put("/api/projects/" + project_id.value, {
      project_name: project_name.value,
      project_description: project_description.value,
      project_progress: project_progress.value,
      project_status: project_status.value,
    })
    .then(function (response) {
      // handle success
      console.log(response);
      loading.value = !loading.value;
      console.log(response.data.project_id);
      //window.location.href = "/console/project/"+response.data.project_id+"/settings";
      toastr.success("Project has been updated.", "Successful updated!");
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

function useProjectDelete() {
  loading.value = !loading.value;
  // Make a request for a user with a given ID
  axios
    .delete("/api/projects/" + project_id.value)
    .then(function (response) {
      // handle success
      console.log(response);
      loading.value = !loading.value;
      console.log(response.data.project_id);
      window.location.href = "/console";
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
