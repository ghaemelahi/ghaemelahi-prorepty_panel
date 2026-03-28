{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
@extends('layouts.auth_panels.auth_app')
@section('title', 'تغییر رمز عبور')
@section('content')
    <div class="container-fluid">
        <div class="main-content d-flex flex-column px-0">

            <div class="m-auto mw-510 py-5">
                <form>
                    <div class="d-flex align-items-center gap-4 mb-3">
                        <h4 class="fs-3 mb-0">بازیابی گذرواژه</h4>
                        <a href="index.html">
                            <img src="{{asset('assets/images/logo.svg')}}" alt="logo">
                        </a>
                    </div>
                    <p class="fs-18 mb-5">رمز عبور جدید شما باید با رمزهای عبور قبلی و پیشین شما در سایت متفاوت باشد.
                    </p>
                    <div class="card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <div class="form-group mb-4">
                                <label class="label">ایمیل</label>
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control h-58 text-dark">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="label">گذرواژه جدید</label>
                                <div class="form-group">
                                    <div class="password-wrapper position-relative">
                                        <input type="password" id="password" class="form-control h-58 text-dark"
                                            >
                                        <i style="color: #A9A9C8; font-size: 16px; left: 15px !important;"
                                            class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label class="label">تکرار گذرواژه</label>
                                <div class="form-group">
                                    <div class="password-wrapper position-relative">
                                        <input type="password_confirmation" id="password" class="form-control h-58 text-dark"
                                            >
                                        <i style="color: #A9A9C8; font-size: 16px; left: 15px !important;"
                                            class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="btn btn-primary fs-16 fw-semibold text-dark heading-fornt py-2 py-md-3 px-4 text-white w-100">
                        تنظیم گذرواژه جدید
                    </button>
                </form>
                    <a href="{{route('login')}}" class="d-block text-center mt-3 text-decoration-none fs-16 text-primary">
                        <i class="ri-arrow-right-s-line fs-16"></i>
                        <span>بازگشت به صفحه ورود</span>
                    </a>
            </div>

        </div>
    </div>
@endsection
