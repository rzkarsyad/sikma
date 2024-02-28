@extends('layouts.main')
@section('title')
    Aktivitas Mahasiswa
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Aktivitas Mahasiswa</h4>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <h5>Data Aktivitas</h5>
                                        <p class="card-title-desc">Tabel ini berisi seluruh kegiatan aktivitas dari kampus
                                            yang
                                            diikuti oleh mahasiswa.
                                        </p>
                                    </div>
                                    <div class="row g-3 justify-content-start">

                                        @include('components.lib.filter-angkatan')

                                        @include('components.lib.filter-prodi')

                                        <div class="col-md-auto">
                                            <div class="dropdown">
                                                <button class="btn btn-filter dropdown-toggle" type="button"
                                                    id="dropdownTingkat" data-bs-toggle="dropdown" aria-expanded="false"
                                                    style="width: fit-content;">
                                                    Pilih Tingkat <i class="ri-arrow-down-s-line"></i>
                                                </button>

                                                <div class="container">
                                                    <ul class="dropdown-menu py-0" aria-labelledby="dropdownTingkat"
                                                        style="max-height: 200px; overflow-y: auto; width: 200px;">
                                                        <div class="container pt-3 px-3">
                                                            <span class="text-muted">Pilih Tingkat</span>
                                                            <li class="mb-2 mt-2">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="filter-kategori-all" value="">
                                                                <label class="form-check-label ms-1"
                                                                    for="filter-kategori-all">Semua</label>
                                                            </li>
                                                            @foreach ($kategori as $kategoriItem)
                                                                <li class="mb-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input filter-kategori"
                                                                            type="checkbox"
                                                                            id="filter-kategori-{{ $kategoriItem }}"
                                                                            value="{{ $kategoriItem }}"
                                                                            data-filter-type="kategori">
                                                                        <label class="form-check-label"
                                                                            for="filter-kategori-{{ $kategoriItem }}">{{ $kategoriItem }}</label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                        <li class="dropdown-divider"></li>
                                                        <li class="sticky-bottom bg-white mt-2">
                                                            <button
                                                                class="btn text-primary fw-bold w-100 d-block text-start"
                                                                id="resetKategori">
                                                                Reset Filter
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-auto">
                                            <div class="dropdown">
                                                <button class="btn btn-filter dropdown-toggle" type="button"
                                                    id="dropdownKegiatan" data-bs-toggle="dropdown" aria-expanded="false"
                                                    style="width: fit-content;">
                                                    Pilih Kegiatan <i class="ri-arrow-down-s-line"></i>
                                                </button>

                                                <div class="container">
                                                    <ul class="dropdown-menu py-0" aria-labelledby="dropdownKegiatan"
                                                        style="max-height: 250px; overflow-y: auto; width: 300px;">
                                                        <div class="container pt-3 px-3">
                                                            <span class="text-muted">Pilih Kegiatan</span>
                                                            <li class="mb-2 mt-2">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="filter-kegiatan-all" value="">
                                                                <label class="form-check-label ms-1"
                                                                    for="filter-kegiatan-all">Semua</label>
                                                            </li>
                                                            @foreach ($kegiatan as $id => $nama)
                                                                <li class="mb-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input filter-kegiatan"
                                                                            type="checkbox"
                                                                            id="filter-kegiatan-{{ $id }}"
                                                                            value="{{ $id }}"
                                                                            data-filter-type="kegiatan">
                                                                        <label class="form-check-label"
                                                                            for="filter-kegiatan-{{ $id }}">{{ $nama }}</label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                        <li class="dropdown-divider"></li>
                                                        <li class="sticky-bottom bg-white mt-2">
                                                            <button
                                                                class="btn text-primary fw-bold w-100 d-block text-start"
                                                                id="resetKegiatan">
                                                                Reset Filter
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-auto">
                                            <div class="dropdown">
                                                <button class="btn btn-filter dropdown-toggle" type="button"
                                                    id="dropdownTahun" data-bs-toggle="dropdown" aria-expanded="false"
                                                    style="width: fit-content;">
                                                    Pilih Tahun Kegiatan<i class="ri-arrow-down-s-line"></i>
                                                </button>

                                                <div class="container">
                                                    <ul class="dropdown-menu py-0" aria-labelledby="dropdownTahun"
                                                        style="max-height: 230px; overflow-y: auto; width: 200px;">
                                                        <div class="container pt-3 px-3">
                                                            <span class="text-muted">Pilih Tahun</span>
                                                            <li class="mb-2 mt-2">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="filter-tahun-all" value="">
                                                                <label class="form-check-label ms-1"
                                                                    for="filter-tahun-all">Semua</label>
                                                            </li>
                                                            @foreach ($tahun as $tahunItem)
                                                                <li class="mb-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input filter-tahun"
                                                                            type="checkbox"
                                                                            id="filter-tahun-{{ $tahunItem }}"
                                                                            value="{{ $tahunItem }}"
                                                                            data-filter-type="tahun">
                                                                        <label class="form-check-label"
                                                                            for="filter-tahun-{{ $tahunItem }}">{{ $tahunItem }}</label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                        <li class="dropdown-divider"></li>
                                                        <li class="sticky-bottom bg-white mt-2">
                                                            <button
                                                                class="btn text-primary fw-bold w-100 d-block text-start"
                                                                id="resetTahun">
                                                                Reset Filter
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        @include('components.lib.btn-reset')

                                    </div>

                                    @include('components.lib.chip-filter')

                                    <hr>
                                    <div class="mt-4">
                                        {!! $dataTable->table([
                                            'class' => 'table table-striped nowrap align-middle',
                                            'style' => 'width:100%;',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>

    @include('components.lib.modal-img')
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script src="{{ asset('assets/js/filter-aktivitas.js') }}"></script>
@endpush
