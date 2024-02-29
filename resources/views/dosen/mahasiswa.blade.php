@extends('layouts.main')
@section('title')
    Mahasiswa
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
                                        <h5>Data Mahasiswa</h5>
                                        <p class="card-title-desc">Tabel ini berisi seluruh mahasiswa yang terdaftar di
                                            universitas.
                                        </p>
                                    </div>
                                    <div class="row g-3 justify-content-start">

                                        @include('components.lib.filters.filter-angkatan')

                                        @include('components.lib.filters.filter-prodi')

                                        <div class="col-md-auto">
                                            <div class="dropdown">
                                                <button class="btn btn-filter dropdown-toggle" type="button"
                                                    id="dropdownJalur" data-bs-toggle="dropdown" aria-expanded="false"
                                                    style="width: fit-content;">
                                                    Pilih Jalur Masuk <i class="ri-arrow-down-s-line"></i>
                                                </button>

                                                <div class="container">
                                                    <ul class="dropdown-menu py-0" aria-labelledby="dropdownJalur"
                                                        style="max-height: 250px; overflow-y: auto; width: 300px;">
                                                        <div class="container pt-3 px-3">
                                                            <span class="text-muted">Pilih Jalur</span>
                                                            <li class="mb-2 mt-2">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="filter-jalur-all" value="">
                                                                <label class="form-check-label ms-1"
                                                                    for="filter-jalur-all">Semua</label>
                                                            </li>
                                                            @foreach ($jalur as $id => $nama)
                                                                <li class="mb-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input filter-jalur"
                                                                            type="checkbox"
                                                                            id="filter-jalur-{{ $id }}"
                                                                            value="{{ $id }}"
                                                                            data-filter-type="jalur">
                                                                        <label class="form-check-label"
                                                                            for="filter-jalur-{{ $id }}">{{ $nama }}</label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                        <li class="dropdown-divider"></li>
                                                        <li class="sticky-bottom bg-white mt-2">
                                                            <button
                                                                class="btn text-primary fw-bold w-100 d-block text-start"
                                                                id="resetJalur">
                                                                Reset Filter
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        @include('components.lib.buttons.btn-reset')

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
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script src="{{ asset('assets/js/filter-mhs.js') }}"></script>
@endpush
