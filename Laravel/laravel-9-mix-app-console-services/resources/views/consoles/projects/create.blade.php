@extends('layouts.console')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Console</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Console</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card shadow-none">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">Create a new project</h3>
        </div>
        <div class="card-body">
            <form id="project-create" action="/console/project/store" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="staticProject" class="col-lg-2 col-form-label">Project name</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control @error('project_name') is-invalid @enderror" id="project_name" name="project_name" aria-describedby="ProjectHelp">
                        @error('project_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small id="ProjectHelp" class="form-text text-muted">Don't leave this empty</small>
                        <small id="ProjectHelp" class="form-text text-muted">Don't use special characters (4-byte Unicode)</small>
                        <small id="ProjectHelp" class="form-text text-muted">Enter no more than 100 characters</small>
                    </div>
                </div>
                <p>A provider is an individual developer, company, or organization that provides services. For more details, see the <a href="/docs">document</a></p>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer p-0">
            <div class="btn-group w-100" role="group" aria-label="Basic Project">
                <a href="/console" class="btn btn-secondary btn-flat">Cancel</a>
                <button type="button" class="btn btn-primary btn-flat" onclick="event.preventDefault(); document.getElementById('project-create').submit();">Create</button>
            </div>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

@endsection