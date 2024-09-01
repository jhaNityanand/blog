@extends('auth.layouts.app')

@section('content')
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    <div class="text-center account-logo-box">
                        <div class="mt-2 mb-2">
                            <a href="index.html" class="text-success">
                                <span><img src="{{ url('public\assets\images\logo.png') }}" alt="" height="36"></span>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="text-center mb-4">
                            <p class="text-muted mb-0">Enter your email address and we'll send you an email with instructions to reset your password. </p>
                        </div>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email Address') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                            </div>

                            <div class="form-group account-btn text-center mt-2 row">
                                <div class="col-12">
                                    <button class="btn width-md btn-bordered btn-danger waves-effect waves-light" type="submit">Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-5">
                    <div class="col-sm-12 text-center">
                        <p class="text-muted">Already have account?<a href="{{ route('login') }}" class="text-primary ml-1"><b>Sign In</b></a></p>
                    </div>
                </div>
            </div>

        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
@endsection
