<template>
  <TheWelcome v-if="!projects.length" />

  <!-- Content Header (Page header) -->
  <section v-if="projects.length" class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Console</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Console</li>
          </ol>
        </div>
      </div>
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">CPU Traffic</span>
              <span class="info-box-number">
                10
                <small>%</small>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Members</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section v-if="projects.length" class="content">
    <!-- Default box -->
    <div class="card card-primary card-outline">
      <div class="card-header border-0">
        <h3 class="card-title">Projects</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="/console" data-source-selector="#card-refresh-content">
            <i class="fas fa-sync-alt"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
          <thead>
            <tr>
              <th style="width: 1%">#</th>
              <th style="width: 30%">Project Name</th>
              <th style="width: 20%">Project Progress</th>
              <th style="width: 9%" class="text-center">Status</th>
              <th style="width: 20%"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in projects" :todo="item" :key="item.created_at">
              <td>#</td>
              <td>
                <router-link v-bind:to="'/console/project/' + item.project_id" class="h5"> {{ item.project_name }} </router-link>
                <br />
                <small> Created {{ formatDate(item.created_at) }} </small>
              </td>
              <td class="project_progress">
                <div class="progress">
                  <div class="progress-bar" id="project_progress" role="progressbar" :style="{ width: item.project_progress + '%' }" aria-valuenow="{{ item.project_progress }}" aria-valuemin="0" aria-valuemax="100">
                    <span class="mx-1">Progress {{ item.project_progress }}%</span>>
                  </div>
                </div>
              </td>
              <td class="project-state">
                <span class="badge badge-success">Success</span>
              </td>
              <td class="project-actions text-right">
                <div class="dropdown">
                  <button class="btn btn-default btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-folder"></i></button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <RouterLink v-bind:to="'/console/project/' + item.project_id" class="dropdown-item" href="#"><i class="fas fa-eye"></i> View</RouterLink>
                    <RouterLink v-bind:to="'/console/project/' + item.project_id + '/settings'" class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</RouterLink>
                    <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</template>

<script setup>
import TheWelcome from "../components/TheWelcome.vue";
import { ref } from "vue";
import axios from "axios";
import moment from "moment";

const projects = ref(window.projects);

// Make a request for a user with a given ID
axios
  .get("/api/projects")
  .then(function (response) {
    // handle success
    console.log(response);
    projects.value = response.data;
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .then(function () {
    // always executed
  });

function formatDate(value) {
  return moment(String(value)).format("MM/DD/YYYY hh:mm:ss");
}
</script>

<style lang="scss" scoped></style>
