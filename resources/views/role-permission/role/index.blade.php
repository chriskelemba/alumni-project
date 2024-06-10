<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    @extends('role-permission.nav-links')
    @section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif


                <div class="card mt-3">
                    <div class="card-header">
                        <div>
                            <h4>Roles
                                <a href="{{ url('roles/create') }}" class="btn btn-primary float-end">Add Role</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th class="w-50">Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="btn btn-warning">Add / Edit Role Permission</a>

                                            @can('update role')
                                                <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-success">Edit</a>
                                            @endcan

                                            @can('delete role')
                                                <a href="{{ url('roles/'.$role->id.'/delete') }}" class="btn btn-danger">Delete</a>
                                            @endcan
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>