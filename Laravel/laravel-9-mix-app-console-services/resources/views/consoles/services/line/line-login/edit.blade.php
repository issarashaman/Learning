@extends('layouts.console')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{ $project->project_name }} - {{ $service->service_name }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item"><a href="/console">Console</a></li>
          <li class="breadcrumb-item"><a href="/console/project/{{ $project->project_id }}">{{ $project->project_name }}</a></li>
          <li class="breadcrumb-item active">{{ $service->service_name }}</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box shadow-none">
          <span class="info-box-icon bg-success elevation-1"><i class="fab fa-line"></i></span>

          <div class="info-box-content">
            <h4 class="info-box-text">{{ $service->service_name }}</h4>
            <span class="info-box-number">
              <span class="">LINE Login</span>
              <span class=" border-right mx-2"></span>
              <span class="badge badge-pill badge-primary p-2">Admin</span>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card shadow-none">
    <div class="card-header">
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link" href="/console/service/{{ $service->service_id }}/basics">Basic settings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/console/service/{{ $service->service_id }}/line-login">LINE Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/console/service/{{ $service->service_id }}/statistics">Statistics</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <h2 class="pb-4">Basic settings</h2>
      <h3>Basic information</h3>
      <form id="service-update" action="/console/service/{{ $service->service_id }}/line-login/update" method="POST">
        @csrf
        <div class="form-group row">
          <label for="service_id" class="col-lg-2 col-form-label">Service ID</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="service_id" name="service_id" value="{{ $service->service_id }}" aria-describedby="ServiceHelp" disabled>
          </div>
        </div>
        <hr>
        <div class="form-group row">
          <label for="channel_id" class="col-lg-2 col-form-label">Channel ID</label>
          <div class="col-lg-10">
            <input type="text" class="form-control @error('channel_id') is-invalid @enderror" id="channel_id" name="channel_id" value="{{ $service_line_login->channel_id }}" aria-describedby="ServiceHelp">
            @error('channel_id')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            <small id="ServiceHelp" class="form-text text-muted">Don't leave this empty</small>
            <p class="mt-2">
              <button type="button" class="btn btn-default btn-flat">Edit</button>
            </p>
            <p class="mt-2">
              <button type="button" class="btn btn-primary btn-flat" onclick="event.preventDefault(); document.getElementById('service-update').submit();">Update</button>
              <button type="button" class="btn btn-secondary btn-flat ml-2">Cancel</button>
            </p>
          </div>
        </div>
        <hr>
        <div class="form-group row">
          <label for="channel_secret" class="col-lg-2 col-form-label">Channel secret</label>
          <div class="col-lg-10">
            <input type="text" class="form-control @error('channel_secret') is-invalid @enderror" id="channel_secret" name="channel_secret" value="{{ $service_line_login->channel_secret }}" aria-describedby="ServiceHelp">
            @error('channel_secret')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            <small id="ServiceHelp" class="form-text text-muted">Don't leave this empty</small>
            <p class="mt-2">
              <button type="button" class="btn btn-default btn-flat">Edit</button>
            </p>
            <p class="mt-2">
              <button type="button" class="btn btn-primary btn-flat" onclick="event.preventDefault(); document.getElementById('service-update').submit();">Update</button>
              <button type="button" class="btn btn-secondary btn-flat ml-2">Cancel</button>
            </p>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <p class="text-center">Available features might defer based on the account with which you are currently logged in. For details, check the <a href="/docs">document</a></p>
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

@endsection