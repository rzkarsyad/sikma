@extends('layouts.main')
@section('title')
    Profile
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Profile</h4>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row gx-3 gy-2">
                    <div class="col-4">
                        <div class="col">
                            <div class="card shadow-none">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/users/avatar.jpeg') }}" alt="foto profil"
                                            class="rounded-circle avatar">
                                        <div class="col ms-2">
                                            <div class="col ms-2">
                                                <span class="h4">{{ $dosen->nama }}</span>
                                            </div>
                                            <div class="col ms-2 mt-1">
                                                <span class="text-mute">Dosen</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-none">
                                <div class="card-body">
                                    <div class="col-md-auto">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            <a class="nav-link p-3 @if (!session('success') && !session('successUpdatePribadi') && !session('successUpdateDarurat')) active @endif"
                                                id="v-pills-data-tab" data-bs-toggle="pill" href="#data-pribadi"
                                                role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                <i class="fas fa-user me-2"></i>
                                                Data Pribadi
                                            </a>
                                            <a class="nav-link p-3 @if (session('successUpdatePribadi')) active @endif"
                                                id="v-pills-kontak-tab" data-bs-toggle="pill" href="#kontak-pribadi"
                                                role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                                <i class="fas fa-phone-alt me-2"></i>
                                                Kontak Pribadi
                                            </a>
                                            <a class="nav-link p-3 @if (session('success')) active @endif"
                                                id="v-pills-password-tab" data-bs-toggle="pill" href="#ganti-sandi"
                                                role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                <i class="fas fa-lock me-2"></i>
                                                Ganti Kata Sandi
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                            <div class="tab-pane fade @if (!session('success') && !session('successUpdatePribadi') && !session('successUpdateDarurat')) show active @endif"
                                                id="data-pribadi" role="tabpanel" aria-labelledby="v-pills-data-tab">
                                                <h4 class="fw-semibold">Informasi Pribadi</h4>
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Nama</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">{{ $dosen->nama }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Email</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">{{ $dosen->email }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Jabatan</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">{{ $dosen->jabatan }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Jenis Kelamin</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">
                                                                {{ $dosen->jns_kelamin == 'P' ? 'Pria' : 'Wanita' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h6 class="fw-semibold mt-2 mb-3">Informasi Akademik</h6>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Perguruan Tinggi</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">{{ $dosen->institusi }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>NIDN</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">{{ $dosen->nidn }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Fakultas</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">
                                                                {{ $dosen->prodi->fakultas->nama }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Program Studi</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">{{ $dosen->prodi->nama }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade @if (session('successUpdatePribadi')) show active @endif"
                                                id="kontak-pribadi" role="tabpanel" aria-labelledby="v-pills-kontak-tab">

                                                <h4 class="fw-semibold">Kontak Pribadi</h4>

                                                @if (session('successUpdatePribadi'))
                                                    <div class="alert alert-success">{{ session('successUpdatePribadi') }}
                                                    </div>
                                                @endif

                                                @if (session('error'))
                                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                                @endif
                                                <div class="col">
                                                    <form class="row gx-3 gy-2 align-items-center" method="POST"
                                                        action="{{ route('dosen.contact.update') }}">
                                                        @csrf

                                                        <div class="col-sm-12">
                                                            <label class="form-label" for="no_hp">Nomor Ponsel</label>
                                                            <input type="text" class="form-control" id="no_hp"
                                                                name="no_hp" placeholder="{{ $dosen->no_hp }}"
                                                                value="{{ $dosen->no_hp }}" required>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-primary mt-3">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade @if (session('success')) show active @endif"
                                                id="ganti-sandi" role="tabpanel" aria-labelledby="v-pills-password-tab">

                                                <h4 class="fw-semibold">Ganti Kata Sandi</h4>
                                                @if (session('success'))
                                                    <div class="alert alert-success">{{ session('success') }}</div>
                                                @endif

                                                @if (session('error'))
                                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                                @endif

                                                <form class="row gx-3 gy-2 align-items-center" method="POST"
                                                    action="{{ route('dosen.change.password') }}">
                                                    @csrf

                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="old_password">Kata Sandi
                                                            Sekarang</label>
                                                        <input type="password"
                                                            class="form-control @error('old_password') is-invalid @enderror"
                                                            id="old_password" name="old_password"
                                                            placeholder="Kata sandi sekarang" required>
                                                        @error('current_password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="new_password">Kata Sandi
                                                            Baru</label>
                                                        <input type="password"
                                                            class="form-control @error('new_password') is-invalid @enderror"
                                                            id="new_password" name="new_password"
                                                            placeholder="Kata sandi baru" required>

                                                        @error('new_password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="new_password_confirmation">Ulangi
                                                            Kata
                                                            Sandi
                                                            Baru</label>
                                                        <input type="password" class="form-control"
                                                            id="new_password_confirmation"
                                                            name="new_password_confirmation"
                                                            placeholder="Ketik ulang sandi baru" required>
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
            <!-- end page title -->
        </div>
    </div>
@endsection
