@extends('layouts.main')
@section('title')
    Profil
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Profil</h4>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row gx-3 gy-2">
                    <div class="col-4">
                        <div class="col">
                            <div class="card shadow-none rounded-4">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ Avatar::create(ucfirst(Auth::user()->nim_nidn))->setDimension(72)->setFontSize(32)->toBase64() }}"
                                            alt="Avatar">
                                        <div class="col ms-2">
                                            <div class="col ms-2">
                                                <span class="h4">{{ ucfirst(Auth::user()->nim_nidn) }}</span>
                                            </div>
                                            <div class="col ms-2 mt-1">
                                                <span class="text-mute">Administrator</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card shadow-none rounded-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md">
                                        <h4 class="fw-semibold">Ganti Kata Sandi</h4>

                                        @include('components.lib.toast-success')

                                        @include('components.lib.toast-error')

                                        <form class="row gx-3 gy-2 align-items-center" method="POST"
                                            action="{{ route('admin.change.password') }}">
                                            @csrf

                                            <div class="col-sm-12">
                                                <label class="form-label" for="old_password">Kata Sandi
                                                    Sekarang</label>
                                                <input type="password"
                                                    class="form-control @error('old_password') is-invalid @enderror"
                                                    id="old_password" name="old_password">
                                                @error('old_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="form-label" for="new_password">Kata Sandi
                                                    Baru</label>
                                                <input type="password"
                                                    class="form-control  @error('new_password') is-invalid @enderror"
                                                    id="new_password" name="new_password">
                                                @error('new_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="form-label" for="new_password_confirmation">Konfirmasi
                                                    Kata Sandi
                                                    Baru</label>
                                                <input type="password"
                                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                    id="new_password_confirmation" name="new_password_confirmation">
                                                @error('new_password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary mt-3">Simpan
                                                    Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var error = {!! json_encode(session('error')) !!};

            if (error) {
                showToast('#ganti-sandi');
            }

            function showToast(tabId) {
                var toastEl = document.querySelector(tabId + ' .toast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }

            $('input').on('input', function() {
                $(this).removeClass('is-invalid').next('.invalid-feedback').remove();
            });
        });
    </script>
@endpush
