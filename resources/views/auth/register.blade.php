@extends('layout.regis')
@section('content')
    @include('sweetalert::alert')
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left"> <img class="img-fluid" src="assets/img/logo.png" alt="Logo"> </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1 class="mb-3">Register</h1>
                            <form action="{{ route('register-user') }}" method="post">
                                @if (Session::has('success'))
                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                @endif
                                @if (Session::has('fail'))
                                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                                @endif
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter Name"
                                        value="{{ old('name') }}" name="name">
                                    <span class="text-danger from-control">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="email" placeholder="Enter Email"
                                        value="{{ old('email') }}" name="email">
                                    <span class="text-danger from-control">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Enter Password"
                                        name="password">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Enter Confirm Password"
                                        name="password_confirmation">
                                    <span class="text-danger from-control">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Register</button>
                                </div>
                            </form>
                            <div class="login-or"> <span class="or-line"></span> <span
                                    class="span-or">or</span> </div>
                            <div class="social-login"> <span>Register with</span> <a href="#" class="facebook"><i
                                        class="fab fa-facebook-f"></i></a><a href="#" class="google"><i
                                        class="fab fa-google"></i></a> </div>
                            <div class="text-center dont-have">Already have an account? <a
                                    href="{{ route('login') }}">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
