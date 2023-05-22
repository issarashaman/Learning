@extends('layouts.console')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $project->project_name }} - Settings</h1>
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
                    <a class="nav-link" href="/console/project/{{ $project->project_id }}/roles">Roles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/console/project/{{ $project->project_id }}/settings">Settings</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h2 class="pb-4">Project settings</h2>
            <h3>Basic information</h3>
            <form id="project-update" action="/console/project/{{ $project->project_id }}/update" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="project_id" class="col-lg-2 col-form-label">Project ID</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="project_id" name="project_id" value="{{ $project->project_id }}" aria-describedby="ProjectHelp" disabled>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="project_name" class="col-lg-2 col-form-label">Project name</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control @error('project_name') is-invalid @enderror" id="project_name" name="project_name" value="{{ $project->project_name }}" aria-describedby="ProjectHelp">
                        @error('project_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small id="ProjectHelp" class="form-text text-muted">Don't leave this empty</small>
                        <small id="ProjectHelp" class="form-text text-muted">Don't use special characters (4-byte Unicode)</small>
                        <small id="ProjectHelp" class="form-text text-muted">Enter no more than 100 characters</small>
                        <p class="mt-2">
                            <button type="button" class="btn btn-default btn-flat">Edit</button>
                        </p>
                        <p class="mt-2">
                            <button type="button" class="btn btn-primary btn-flat" onclick="event.preventDefault(); document.getElementById('project-update').submit();">Update</button>
                            <button type="button" class="btn btn-secondary btn-flat ml-2">Cancel</button>
                        </p>
                    </div>
                </div>
            </form>
            <h3>Delete this project</h3>
            <form id="project-delete" action="/console/project/{{ $project->project_id }}/delete" method="POST">
                @csrf
                <p>Only an Admin can delete a project, and only when the projects has no services.</p>
                <button type="button" class="btn btn-danger btn-flat" onclick="event.preventDefault(); document.getElementById('project-delete').submit();">Delete</button>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <p>A project is an individual developer, company, or organization that projects services. For more details, see the <a href="/docs">document</a></p>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

@endsection