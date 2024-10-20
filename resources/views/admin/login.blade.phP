@extends('components.layout')

@section('title', 'Admin Login')

@section('content')

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card" id="loginCard" style="width: 350px;">
        <div class="row g-0 p-4 border-bottom">
            <h3 class="card-title"><b>ADMIN LOGIN</b></h3>
        </div>
        <div class="row">
            <div class="card-body p-4">
                <form method="POST" id="adminLoginForm" action="{{ route('admin.login.post') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="adminUsername" class="form-label"><strong>Username: </strong></label>
                        <input type="text" class="form-control" name="adminUsername" id="adminUsername" required>
                    </div>
                    <div class="mb-3">
                        <label for="adminPassword" class="form-label"><strong>Password: </strong></label>
                        <input type="password" class="form-control" name="adminPassword" id="adminPassword" required>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Display success messages --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100" id="loginButton">Login</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.register') }}">
    @csrf  <!-- Include CSRF token for security -->

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
</form>

<script src="{{ asset('js/admin/adminauthentication.js') }}"></script>

@endsection



