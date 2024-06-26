@extends('base')
@section('title', "Ganti Password")
@section('content')
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Register Card -->
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <a href="{{ url('login') }}" class="app-brand-link gap-2">
                        <span class="app-brand-text demo text-body fw-bolder">{{ env('APP_NAME') }}</span>
                    </a>
                </div>
                <!-- /Logo -->

                @include('partials/toasts')

                <form id="formAuthentication" class="mb-3" action="{{ url('change-password') }}"
                method="POST" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                        id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}"
                        onkeyup="return forceLower(this);">
                        <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password Baru</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="············" aria-describedby="password">
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            <div class="invalid-feedback">@error('password') {{ $message }} @enderror</div>
                        </div>
                    </div>
                    <button class="btn btn-info d-grid w-100">
                    Ganti Password
                    </button>
                    <a href="{{ url('signin') }}"
                     class="btn btn-dark d-grid w-100 mt-2">Kembali</a>
                </form>

            </div>
        </div>
        <!-- Register Card -->
    </div>
</div>
@endsection
