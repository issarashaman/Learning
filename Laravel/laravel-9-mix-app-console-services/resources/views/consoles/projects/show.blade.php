@extends('layouts.console')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{ $project->project_name }} - Services</h1>
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

      @if (count($services) === 0)

      <section class="jumbotron text-center bg-light mb-0">
        <div class="container">
          <h1>This project doesn't have any services yet</h1>
          <p class="lead text-muted">To create one, choose a service type below</p>
        </div>
      </section>

      @else

      <section class="py-4">
        <div class="container">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

            @foreach ($services as $key)
            <div class="col">
              <div class="card shadow-sm border">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                  @if ($key->service_type === "line-login")
                  <title>LINE Login</title>
                  <rect width="100%" height="100%" fill="#28a745" />
                  <text x="50%" y="50%" fill="#eceeef" dy=".3em">LINE Login</text>
                  @elseif ($key->service_type === "line-messaging-api")
                  <title>LINE Messaging API</title>
                  <rect width="100%" height="100%" fill="#28a745" />
                  <text x="50%" y="50%" fill="#eceeef" dy=".3em">LINE Messaging API</text>
                  @endif
                </svg>

                <div class="card-body">
                  <h4 class="card-text">{{ $key->service_name }}</h4>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      @if ($key->service_type === "line-login")
                        <a href="/console/service/{{ $key->service_id }}/line-login" class="btn btn-sm btn-success">LINE Login</a>
                      @elseif ($key->service_type === "line-messaging-api")
                        <a href="/console/service/{{ $key->service_id }}/line-messaging-api" class="btn btn-sm btn-success">LINE Messaging API</a>
                      @endif
                      <button type="button" class="btn btn-sm btn-secondary">Document</button>
                    </div>
                    <a href="/console/service/{{ $key->service_id }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-cog"></i></a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach

          </div>
        </div>
      </section>

      <section class="jumbotron text-center bg-light mb-0">
        <div class="container">
          <h1>Add a new service</h1>
          <p class="lead text-muted">Choose a service type to continue</p>
        </div>
      </section>

      @endif

      <div class="services py-5">
        <div class="container">
          <h1>LINE Service</h1>
          <div class="row">
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm border">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                  <title>LINE Login</title>
                  <rect width="100%" height="100%" fill="#28a745" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">LINE Login</text>
                </svg>

                <div class="card-body">
                  <p class="card-text">LINE Login</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="/console/service/create?project={{ $project->project_id }}&type=line-login" class="btn btn-sm btn-success">Add LINE Login</a>
                      <button type="button" class="btn btn-sm btn-secondary">Document</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm border">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                  <title>LINE Messaging API</title>
                  <rect width="100%" height="100%" fill="#28a745" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">LINE Messaging API</text>
                </svg>

                <div class="card-body">
                  <p class="card-text">LINE Messaging API</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="/console/service/create?project={{ $project->project_id }}&type=line-messaging-api" class="btn btn-sm btn-success">Add LINE Messaging API</a>
                      <button type="button" class="btn btn-sm btn-secondary">Document</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr>

      <div class="services py-5">
        <div class="container">
          <h1>Facebook Service</h1>
          <div class="row">
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm border">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                  <title>Placeholder</title>
                  <rect width="100%" height="100%" fill="#007bff" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                </svg>

                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm border">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                  <title>Placeholder</title>
                  <rect width="100%" height="100%" fill="#007bff" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                </svg>

                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm border">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                  <title>Placeholder</title>
                  <rect width="100%" height="100%" fill="#007bff" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                </svg>

                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr>

      <div class="services py-5">
        <div class="container">
          <h1>Google Service</h1>
          <div class="row">
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm border">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                  <title>Placeholder</title>
                  <rect width="100%" height="100%" fill="#dc3545" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                </svg>

                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm border">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                  <title>Placeholder</title>
                  <rect width="100%" height="100%" fill="#dc3545" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                </svg>

                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm border">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                  <title>Placeholder</title>
                  <rect width="100%" height="100%" fill="#dc3545" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                </svg>

                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

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