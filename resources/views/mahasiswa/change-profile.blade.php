@extends('layouts.main')
@section('title')
    Profile
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

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
                                            <div class="tab-pane fade @if (!session('success') && !session('error') && !session('successUpdatePribadi') && !session('successUpdateDarurat')) show active @endif"
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
                                                    <div class="toast-container position-fixed top-0 end-0 p-3">
                                                        <div id="liveToast" class="toast" role="alert"
                                                            aria-live="assertive" aria-atomic="true">
                                                            <div class="toast-header">
                                                                <i
                                                                    class="ri-checkbox-circle-fill font-size-20 me-2 icon-success"></i>
                                                                <strong class="me-auto fw-bold">Berhasil</strong>
                                                                <small id="toast-time"></small>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="toast" aria-label="Close"></button>
                                                            </div>
                                                            <div class="toast-body">
                                                                {{ session('successUpdatePribadi') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @push('scripts')
                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                var toastEl = document.querySelector('.toast');
                                                                var toast = new bootstrap.Toast(toastEl);
                                                                toast.show();

                                                                var toastTime = document.getElementById('toast-time');
                                                                var startTime = new Date().getTime();

                                                                function updateToastTime() {
                                                                    var currentTime = new Date().getTime();
                                                                    var elapsedTime = Math.floor((currentTime - startTime) / 1000);

                                                                    var timeAgo;
                                                                    if (elapsedTime < 5) {
                                                                        timeAgo = 'Baru saja';
                                                                    } else if (elapsedTime < 60) {
                                                                        timeAgo = elapsedTime + ' detik yang lalu';
                                                                    } else if (elapsedTime < 3600) {
                                                                        var minutes = Math.floor(elapsedTime / 60);
                                                                        timeAgo = minutes + ' menit yang lalu';
                                                                    } else {
                                                                        var hours = Math.floor(elapsedTime / 3600);
                                                                        timeAgo = hours + ' jam yang lalu';
                                                                    }

                                                                    toastTime.textContent = timeAgo;
                                                                    setTimeout(updateToastTime, 1000);
                                                                }

                                                                updateToastTime();
                                                            });
                                                        </script>
                                                    @endpush
                                                @endif

                                                @include('components.lib.toast-error')

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
                                                    <div class="toast-container position-fixed top-0 end-0 p-3">
                                                        <div id="liveToast" class="toast" role="alert"
                                                            aria-live="assertive" aria-atomic="true">
                                                            <div class="toast-header">
                                                                <i
                                                                    class="ri-checkbox-circle-fill font-size-20 me-2 icon-success"></i>
                                                                <strong class="me-auto fw-bold">Berhasil</strong>
                                                                <small id="toast-time"></small>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="toast" aria-label="Close"></button>
                                                            </div>
                                                            <div class="toast-body">
                                                                {{ session('successUpdateDarurat') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @push('scripts')
                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                var toastEl = document.querySelector('.toast');
                                                                var toast = new bootstrap.Toast(toastEl);
                                                                toast.show();

                                                                var toastTime = document.getElementById('toast-time');
                                                                var startTime = new Date().getTime();

                                                                function updateToastTime() {
                                                                    var currentTime = new Date().getTime();
                                                                    var elapsedTime = Math.floor((currentTime - startTime) / 1000);

                                                                    var timeAgo;
                                                                    if (elapsedTime < 5) {
                                                                        timeAgo = 'Baru saja';
                                                                    } else if (elapsedTime < 60) {
                                                                        timeAgo = elapsedTime + ' detik yang lalu';
                                                                    } else if (elapsedTime < 3600) {
                                                                        var minutes = Math.floor(elapsedTime / 60);
                                                                        timeAgo = minutes + ' menit yang lalu';
                                                                    } else {
                                                                        var hours = Math.floor(elapsedTime / 3600);
                                                                        timeAgo = hours + ' jam yang lalu';
                                                                    }

                                                                    toastTime.textContent = timeAgo;
                                                                    setTimeout(updateToastTime, 1000);
                                                                }

                                                                updateToastTime();
                                                            });
                                                        </script>
                                                    @endpush
                                                @endif

                                                @include('components.lib.toast-error')

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

                                                @include('components.lib.toast-success')

                                                @include('components.lib.toast-error')

                                                <form class="row gx-3 gy-2 align-items-center" method="POST"
                                                    action="{{ route('change.password') }}">
                                                    @csrf

                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="old_password">Kata Sandi
                                                            Sekarang</label>
                                                        <input type="password"
                                                            class="form-control @error('old_password') is-invalid @enderror"
                                                            id="old_password" name="old_password" required>
                                                        @error('current_password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="new_password">Kata Sandi
                                                            Baru</label>
                                                        <input type="password" class="form-control" id="new_password"
                                                            name="new_password" required>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label"
                                                            for="new_password_confirmation">Konfirmasi Kata Sandi
                                                            Baru</label>
                                                        <input type="password"
                                                            class="form-control  @error('new_password') is-invalid @enderror"
                                                            id="new_password_confirmation"
                                                            name="new_password_confirmation" required>

                                                        @error('new_password')
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
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successUpdatePribadi = {!! json_encode(session('successUpdatePribadi')) !!};
            var successUpdateDarurat = {!! json_encode(session('successUpdateDarurat')) !!};
            var success = {!! json_encode(session('success')) !!};
            var error = {!! json_encode(session('error')) !!};

            function activateTab(tabId) {
                $('.nav-link').removeClass('active');
                $('.tab-pane').removeClass('show active');
                $(tabId).addClass('show active');
                $('a[href="' + tabId + '"]').addClass('active');
            }

            if (error) {
                activateTab('#ganti-sandi');
                showToast('#ganti-sandi');
            } else {
                if (!successUpdatePribadi && !successUpdateDarurat && !success) {
                    activateTab('#data-pribadi');
                } else if (successUpdatePribadi) {
                    activateTab('#kontak-pribadi');
                } else if (successUpdateDarurat) {
                    activateTab('#kontak-darurat');
                } else if (success) {
                    activateTab('#ganti-sandi');
                }
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
