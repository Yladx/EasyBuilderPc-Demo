@extends('components.layout')

@section('title', 'Login')

@section('content')
    @include('components.header')

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card w-75" id="loginCard">
            <div class="row g-0">
                <!-- Left side (Image) -->
                <div class="col-lg-6 d-lg-flex d-none border border-black" id="loginImage">gagfa</div>

                <!-- Right side (Login form) -->
                <div class="col-lg-6 col-12 d-flex justify-content-center align-items-center">
                    <div class="card-body w-100 p-4">
                        <form method="POST" id="loginForm" action="{{ route('login.post') }}">
                            @csrf <!-- Add CSRF token -->
                            <p><b>Log In to Your Account: </b></p>

                            <!-- Email field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>

                            <!-- Password field -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>

                            <!-- Display error messages -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Remember Me and Forgot Password -->
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-12 d-flex align-items-lg-center justify-content-center p-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="RememberMe" name="remember">
                                        <label class="form-check-label" for="RememberMe">Remember Me?</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 d-flex justify-content-lg-end justify-content-center p-1">
                                    <a href="#" class="text-decoration-none">Forgot Password?</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100" id="loginButton" disabled>Login</button>
                                <span>Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Register here</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script src="js/authentication.js"></script>
@endsection
