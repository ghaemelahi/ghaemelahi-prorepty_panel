
@extends('layouts.auth_panels.auth_app')
@section('title', 'ورود')
@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card bg-white border-0 shadow-lg rounded-10 p-4"
        style="width: 500px; max-width: 100%; padding: 20px; margin: 15px;">
        <div class="card-body">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="d-flex align-items-center gap-4 mb-3 text-center">
                    <a href="index.html">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
                    </a>
                </div>
                
                <div class="form-group mb-4">
                    <label class="label">ایمیل</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label class="label">گذرواژه</label>
                    <div class="password-wrapper position-relative">
                        <input type="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            required autocomplete="current-password">
                        <i class="ri-eye-off-line password-toggle-icon position-absolute top-50 end-0 translate-middle-y"
                            style="color: #A9A9C8; font-size: 16px; left: 15px;"></i>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        مرا به خاطر بسپار
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 text-white">
                    ورود
                </button>
            </form>
        </div>
    </div>
</div>


@endsection