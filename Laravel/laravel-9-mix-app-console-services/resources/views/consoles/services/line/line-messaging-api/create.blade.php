@extends('layouts.console')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $project->project_name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Console</a></li>
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
                    <a class="nav-link active" href="/console/project/{{ $project->project_id }}/services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/console/project/{{ $project->project_id }}/roles">Roles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/console/project/{{ $project->project_id }}/settings">Settings</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h2 class="pb-4">Add a new service</h2>
            <form id="service-create" action="/console/service/line-messaging-api/store" method="POST">
                @csrf
                <h3>Basic information</h3>
                <div class="form-group row">
                    <label for="staticProject" class="col-lg-2 col-form-label">Project</label>
                    <div class="col-lg-10">
                        <input type="hidden" id="project_name" name="project_name" value="{{ $project->project_name }}" required>
                        <select class="form-control" id="project_id" name="project_id" onchange="location = '/console/service/create?project='+this.value+'&type=line-messaging-api';">
                            <option value="{{ $project->project_id }}" selected>{{ $project->project_name }}</option>
                            <option disabled>Select a project</option>
                            @foreach ($projects as $key)
                            <option value="{{ $key->project_id }}">{{ $key->project_name }}</option>
                            @endforeach
                        </select>
                        @error('project_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small class="form-text text-muted">Don't leave this empty</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="service_type" class="col-lg-2 col-form-label">Service type</label>
                    <div class="col-lg-10">
                        <select class="form-control" id="service_type" name="service_type" onchange="location = '/console/service/create?project={{ $project->project_id }}&type=' + this.value;">
                            <option disabled>Select a service type</option>
                            <option value="line-login">LINE Login</option>
                            <option value="line-messaging-api" selected>LINE Messaging API</option>
                        </select>
                        @error('service_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small class="form-text text-muted">Don't leave this empty</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticProject" class="col-lg-2 col-form-label">Service name</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control @error('service_name') is-invalid @enderror" id="service_name" name="service_name" required>
                        @error('service_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small class="form-text text-muted">Don't leave this empty</small>
                        <small class="form-text text-muted">Don't use special characters (4-byte Unicode)</small>
                        <small class="form-text text-muted">Enter no more than 100 characters</small>
                    </div>
                </div>
                <hr>
                <h3>Bot information</h3>
                <div class="form-group row">
                    <label for="staticProject" class="col-lg-2 col-form-label">Bot basic ID</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control @error('bot_basic_id') is-invalid @enderror" id="bot_basic_id" name="bot_basic_id" required>
                        @error('bot_basic_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small class="form-text text-muted">Don't leave this empty</small>
                        <small class="form-text text-muted">Don't use special characters (4-byte Unicode)</small>
                        <small class="form-text text-muted">Enter no more than 100 characters</small>
                    </div>
                </div>
                <hr>
                <h3>LINE Messaging API settings</h3>
                <div class="form-group row">
                    <label for="staticProject" class="col-lg-2 col-form-label">Channel ID</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control @error('channel_id') is-invalid @enderror" id="channel_id" name="channel_id" required>
                        @error('channel_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small class="form-text text-muted">Don't leave this empty</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticProject" class="col-lg-2 col-form-label">Channel secret</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control @error('channel_secret') is-invalid @enderror" id="channel_secret" name="channel_secret" required>
                        @error('channel_secret')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small class="form-text text-muted">Don't leave this empty</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticProject" class="col-lg-2 col-form-label">Channel access token</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control @error('channel_access_token') is-invalid @enderror" id="channel_access_token" name="channel_access_token" required>
                        @error('channel_access_token')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small class="form-text text-muted">Don't leave this empty</small>
                    </div>
                </div>
                <hr>
                <p>
                    <input type="checkbox" id="official_account_terms" required> I have read and agree to the <a href="https://terms2.line.me/official_account_terms_th?lang=th">LINE Official Account Terms of Use</a>
                    <br>
                    <input type="checkbox" id="official_account_api_terms" required> I have read and agree to the <a href="https://terms2.line.me/official_account_api_terms_th?lang=th">LINE Official Account API Terms of Use</a>
                    <br>
                    <input type="checkbox" id="line_terms_policy" required> I have read and acknowledge <a href="https://line.me/th/terms/policy/">LINE Privacy Policy</a>
                    <small id="AgreementHelp" class="form-text text-muted">Select the checkbox after reading the related document</small>
                </p>
                <button type="submit" class="btn btn-primary btn-flat">Create</button>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <p>A provider is an individual developer, company, or organization that provides services. For more details, see the <a href="/docs">document</a></p>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

@endsection