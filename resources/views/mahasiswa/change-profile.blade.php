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
                                        <img src="{{ Avatar::create(Auth::user()->mahasiswa->nama)->setDimension(72)->setFontSize(32)->toBase64() }}"
                                            alt="Avatar">
                                        <div class="col ms-2">
                                            <div class="col ms-2">
                                                <span class="h4">{{ Auth::user()->mahasiswa->nama }}</span>
                                            </div>
                                            <div class="col ms-2 mt-1">
                                                <span class="text-mute">Mahasiswa</span>
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
                                            <a class="nav-link p-3 @if (session('successUpdateDarurat')) active @endif"
                                                id="v-pills-darurat-tab" data-bs-toggle="pill" href="#kontak-darurat"
                                                role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                                <i class="fas fa-exclamation-circle me-2"></i>
                                                Kontak Darurat
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
                                                            <p class="text-mute">{{ Auth::user()->mahasiswa->nama }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Jenis Kelamin</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">
                                                                {{ Auth::user()->mahasiswa->jns_kelamin == 'P' ? 'Pria' : 'Wanita' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Tempat Lahir</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">{{ Auth::user()->mahasiswa->tempat_lahir }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Tanggal Lahir</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">{{ $tglLahir }}</p>
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
                                                            <p class="text-mute">Universitas Al-Irsyad</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Fakultas</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">
                                                                {{ Auth::user()->mahasiswa->prodi->fakultas->nama }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Program Studi</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">{{ Auth::user()->mahasiswa->prodi->nama }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>NIM</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">{{ Auth::user()->mahasiswa->nim }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Jalur Masuk</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">{{ Auth::user()->mahasiswa->jalur->nama }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong>Tahun Masuk</strong>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-mute">
                                                                {{ Auth::user()->mahasiswa->tahun_masuk }}
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
                                                        action="{{ route('ubah.kontak.pribadi') }}">
                                                        @csrf
                                                        <div class="col-sm-12">
                                                            <label class="form-label" for="email">Email</label>
                                                            <input type="text" class="form-control" id="email"
                                                                name="email" placeholder="{{ Auth::user()->email }}"
                                                                value="{{ Auth::user()->email }}" disabled readonly>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label class="form-label" for="no_hp">Nomor Ponsel</label>
                                                            <input type="text" class="form-control" id="no_hp"
                                                                name="no_hp"
                                                                placeholder="{{ Auth::user()->mahasiswa->no_hp }}"
                                                                value="{{ Auth::user()->mahasiswa->no_hp }}" required>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <label class="form-label" for="alamat">Alamat</label>
                                                            <textarea class="form-control" id="alamat" rows="3" name="alamat" required>{{ Auth::user()->mahasiswa->alamat }}</textarea>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-primary mt-3">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade @if (session('successUpdateDarurat')) show active @endif"
                                                id="kontak-darurat" role="tabpanel"
                                                aria-labelledby="v-pills-darurat-tab">

                                                <h4 class="fw-semibold">Kontak Darurat</h4>
                                                @if (session('successUpdateDarurat'))
                                                    <div class="alert alert-success">{{ session('successUpdateDarurat') }}
                                                    </div>
                                                @endif

                                                @if (session('error'))
                                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                                @endif
                                                <form class="row gx-3 gy-2 align-items-center" method="POST"
                                                    action="{{ route('ubah.kontak.darurat') }}">
                                                    @csrf
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="nama_ortu">Nama</label>
                                                        <input type="text" class="form-control" id="nama_ortu"
                                                            name="nama_ortu" placeholder="Nama"
                                                            value="{{ Auth::user()->mahasiswa->nama_ortu }}" required>
                                                    </div>

                                                    <div class="col-sm-12">

                                                        <label class="form-label" for="hubungan_ortu">Hubungan</label>
                                                        <select name="hubungan_ortu"
                                                            value="{{ Auth::user()->mahasiswa->hubungan_ortu }} }}"
                                                            class="form-select" id="hubungan_ortu" required>
                                                            <option value="">Pilih Hubungan</option>
                                                            <option value="Ayah"
                                                                {{ Auth::user()->mahasiswa->hubungan_ortu == 'Ayah' ? 'selected' : null }}>
                                                                Ayah
                                                            </option>
                                                            <option value="Ibu"
                                                                {{ Auth::user()->mahasiswa->hubungan_ortu == 'Ibu' ? 'selected' : null }}>
                                                                Ibu
                                                            </option>
                                                            <option value="Saudara Kandung"
                                                                {{ Auth::user()->mahasiswa->hubungan_ortu == 'Saudara Kandung' ? 'selected' : null }}>
                                                                Saudara Kandung
                                                            </option>
                                                            <option value="Teman"
                                                                {{ Auth::user()->mahasiswa->hubungan_ortu == 'Teman' ? 'selected' : null }}>
                                                                Teman
                                                            </option>
                                                            <option value="Wali"
                                                                {{ Auth::user()->mahasiswa->hubungan_ortu == 'Wali' ? 'selected' : null }}>
                                                                Wali
                                                            </option>
                                                            <option value="Lainnya"
                                                                {{ Auth::user()->mahasiswa->hubungan_ortu == 'Lainnya' ? 'selected' : null }}>
                                                                Lainnya
                                                            </option>
                                                        </select>

                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="no_hp_ortu">Nomor
                                                            telepon</label>
                                                        <input type="text" class="form-control" id="no_hp_ortu"
                                                            name="no_hp_ortu"
                                                            value="{{ Auth::user()->mahasiswa->no_hp_ortu }}"
                                                            placeholder="{{ Auth::user()->mahasiswa->no_hp_ortu }}">
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="submit" class="btn btn-primary mt-3">Simpan
                                                            Perubahan</button>
                                                    </div>
                                                </form>
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
                                                    action="{{ route('change.password') }}">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                document.getElementById('v-pills-password-tab').classList.add('show', 'active');
            @elseif (session('successUpdatePribadi'))
                document.getElementById('v-pills-kontak-tab').classList.add('show', 'active');
            @elseif (session('successUpdateDarurat'))
                document.getElementById('v-pills-darurat-tab').classList.add('show', 'active');
            @else
                document.getElementById('v-pills-data-tab').classList.add('show', 'active');
            @endif
        });
    </script>
@endsection
