{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.auth_panels.auth_app')
@section('title', 'بازیابی رمزعبور')
@section('content')
    <div class="container-fluid">
        <div class="main-content d-flex flex-column px-0">

            <div class="m-auto mw-510 py-5">
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="d-flex align-items-center gap-4 mb-3">
                        <h4 class="fs-3 mb-0">فراموشی گذرواژه؟</h4>
                        <a href="index.html">
                            <img src="{{asset('assets/images/logo.svg')}}" alt="logo">
                        </a>
                    </div>
                    <p class="fs-18 mb-5">ایمیل خود را وارد کنید و ما دستورالعمل هایی را برای فراموش کردن رمز عبور برای
                        شما ارسال می کنیم</p>
                    <div class="card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <div class="form-group">
                                <label class="label">ایمیل</label>
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control h-58 text-dark" placeholder="ایمیل">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="btn btn-primary fs-16 fw-semibold text-dark heading-fornt py-2 py-md-3 px-4 text-white w-100">
                        ارسال لینک بازنشانی
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
