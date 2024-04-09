@extends('layouts.auth-admin')

@section('content')
    <div>
        <div class="text-center">
            <div>
                <a href="" class="">
                    <img src="{{ asset('assets/images/logo-unaic.png') }}" alt="" height="72"
                        class="auth-logo logo-dark mx-auto">
                    <img src="{{ asset('assets/images/logo-unaic.png') }}" alt="" height="20"
                        class="auth-logo logo-light mx-auto">
                </a>
            </div>

            <h4 class="font-size-18 mt-4">Selamat Datang!</h4>
            <p class="text-muted">Silahkan masuk untuk melanjutkan.</p>
        </div>
        @if (session('error'))
            <div class="mt-2 px-2">
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div class="p-2 mt-2">
            <form class="" action="{{ route('admin.login') }}" method="POST">
                @csrf

                <div class="mb-3 auth-form-group-custom mb-4">
                    <i class="ri-user-2-line auti-custom-input-icon"></i>
                    <label for="nim_nidn" class="fw-semibold">Username</label>
                    <input type="text" class="form-control @error('nim_nidn') is-invalid @enderror"
                        value="{{ old('nim_nidn') }}" id="nim_nidn" name="nim_nidn" placeholder="Masukan Username">
                    @error('nim_nidn')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 auth-form-group-custom mb-4">
                    <i class="ri-lock-2-line auti-custom-input-icon"></i>
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Masukan Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Ingat saya') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-center d-grid">
                    <button class="btn btn-primary waves-effect waves-light" type="submit">Masuk</button>
                </div>

            </form>
        </div>

        <div class="mt-5 text-center">
            <p>©
                <script>
                    document.write(new Date().getFullYear())
                </script> SIKMA Universitas Al-Irsyad Cilacap
            </p>
        </div>
    </div>
@endsection
