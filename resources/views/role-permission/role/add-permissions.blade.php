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

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h4>Role: {{ $role->name }}
                                <a href="{{ url('roles') }}" class="btn btn-danger float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">

                                    @error('permission')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <label for="">Permissions</label>
                                    <div class="row">
                                        @foreach ($permissions as $permission)
                                        <div class="col-md-2">
                                            <label>
                                                <input type="checkbox"
                                                name="permission[]"
                                                value="{{ $permission->name }}"
                                                {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                                />
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>