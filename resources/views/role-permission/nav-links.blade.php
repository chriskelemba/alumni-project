<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="/dashboard">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('roles') }}" class="nav-link btn btn-primary text-white mx-2">Roles</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('permissions') }}" class="nav-link btn btn-info text-white mx-2">Permissions</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('users') }}" class="nav-link btn btn-warning text-white mx-2">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
@yield('content')