@extends('layouts.auth')

@section('content')
    <div id="app">
        <section class="section">
            <div class="d-flex flex-wrap align-items-stretch">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white align-middle">
                    <div class="p-4 m-3">
{{--                        <img src="../assets/img/stisla-fill.svg" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">--}}
                        <h4 class="text-dark font-weight-normal" style="margin-top: 17vh">Selamat datang di <span class="font-weight-bold">SI-Tan!</span></h4>
                        <p class="text-muted">Login untuk melanjutkan mengakses SI-Tan.</p>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                                                    <form method="POST" action="#" class="needs-validation" novalidate="">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" tabindex="3"  type="checkbox" name="remember" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-5 text-small">
                            <div class="mt-2">
                                <a href="#">Privacy Policy</a>
                                <div class="bullet"></div>
                                <a href="#">Terms of Service</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{asset("bootstrap/assets/img/unsplash/wallpaperbetter.jpg")}}">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5">
                                <h1 class="mb-2 display-4 font-weight-bold">SI-Tan</h1>
                                <h5 class="font-weight-normal text-muted-transparent">Aplikasi Pengelola Peternakan Berbasis Website</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection




