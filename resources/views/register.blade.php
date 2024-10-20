@extends('components.layout')

@section('title', 'Register')

@section('content')
    @include('components.header')

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card w-75" id="registerCard">
            <div class="row g-0">
                <div class="col-lg-6 d-lg-flex d-none d-lg-block border border-black" id="registerImage">
                    <!-- Image or Content (optional) -->
                </div>
                <div class="col-lg-6 col-12 d-flex justify-content-center align-items-center">
                    <div class="card-body w-100 p-4">


                        <form method="POST"  id="registerForm">
                            @csrf
                            <p><b>Register Your Account:</b></p>

                            <div class="mb-3">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" class="form-control" name="name"  >
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="fname" id="fname" >
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lname" id="lname" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" >
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="rpassword" id="rpassword" >
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="rpassword_confirmation" id="confirmPassword">
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
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100" id="registerButton">Register</button>
                                <span>Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login here</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/authentication.js"></script>
@endsection
