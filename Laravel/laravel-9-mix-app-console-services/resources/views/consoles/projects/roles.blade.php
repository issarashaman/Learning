@extends('layouts.console')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{ $project->project_name }} - Roles</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item"><a href="/console">Console</a></li>
          <li class="breadcrumb-item active">{{ $project->project_name }}</li>
        </ol>
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
          <a class="nav-link" href="/console/project/{{ $project->project_id }}/services">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/console/project/{{ $project->project_id }}/roles">Roles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/console/project/{{ $project->project_id }}/settings">Settings</a>
        </li>
      </ul>
    </div>
    <div class="card-body">

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