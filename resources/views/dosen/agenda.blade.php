@extends('layouts.main')

@section('title')
    Agenda Mahasiswa
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Agenda Mahasiswa</h4>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <h5>Data Agenda</h5>
                                        <p class="card-title-desc">Tabel ini berisi seluruh kegiatan agenda yang
                                            ditambahkan oleh mahasiswa.
                                        </p>
                                    </div>

                                    <div class="row g-3 justify-content-start">

                                        @include('components.lib.filters.filter-angkatan')

                                        @include('components.lib.filters.filter-prodi')

                                        <div class="col-md-auto px-auto">
                                            <div class="dropdown">
                                                <button class="btn btn-filter dropdown-toggle" type="button"
                                                    id="dropdownBimbingan" data-bs-toggle="dropdown" aria-expanded="false"
                                                    style="width: fit-content;">
                                                    Pilih Bimbingan <i class="ri-arrow-down-s-line"></i>
                                                </button>
                                                <div class="container">
                                                    <ul class="dropdown-menu py-0" aria-labelledby="dropdownBimbingan"
                                                        style="max-height: 200px; overflow-y: auto; width: 275px;">
                                                        <div class="container pt-3 px-3">
                                                            <span class="text-muted">Pilih Jenis Bimbingan</span>
                                                            <li class="mb-2 mt-2">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="filter-bimbingan-all" value="">
                                                                <label class="form-check-label ms-1"
                                                                    for="filter-bimbingan-all">Semua</label>
                                                            </li>
                                                            @foreach ($jenis_bimbingan as $value => $label)
                                                                <li class="mb-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input filter-bimbingan"
                                                                            type="checkbox"
                                                                            id="filter-bimbingan-{{ $value }}"
                                                                            value="{{ $value }}"
                                                                            data-filter-type="bimbingan">
                                                                        <label class="form-check-label"
                                                                            for="filter-bimbingan-{{ $value }}">{{ $label }}</label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                        <li class="dropdown-divider"></li>
                                                        <li class="sticky-bottom bg-white">
                                                            <button
                                                                class="btn text-primary fw-bold w-100 d-block text-start"
                                                                id="resetBimbingan">
                                                                Reset Filter
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-auto px-auto">
                                            <div class="dropdown">
                                                <button class="btn btn-filter dropdown-toggle" type="button"
                                                    id="dropdownStatus" data-bs-toggle="dropdown" aria-expanded="false"
                                                    style="width: fit-content;">
                                                    Pilih Status <i class="ri-arrow-down-s-line"></i>
                                                </button>
                                                <div class="container">
                                                    <ul class="dropdown-menu py-0" aria-labelledby="dropdownStatus"
                                                        style="max-height: 175px; overflow-y: auto; width: 200px;">
                                                        <div class="container pt-3 px-3">
                                                            <span class="text-muted">Pilih Status Agenda</span>
                                                            <li class="mb-2 mt-2">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="filter-status-agenda-all" value="">
                                                                <label class="form-check-label ms-1"
                                                                    for="filter-status-agenda-all">Semua</label>
                                                            </li>
                                                            @foreach ($status as $value => $label)
                                                                <li class="mb-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input filter-status-agenda"
                                                                            type="checkbox"
                                                                            id="filter-status-agenda-{{ $value }}"
                                                                            value="{{ $value }}"
                                                                            data-filter-type="status-agenda">
                                                                        <label class="form-check-label"
                                                                            for="filter-status-agenda-{{ $value }}">{{ $label }}</label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                        <li class="dropdown-divider"></li>
                                                        <li class="sticky-bottom bg-white">
                                                            <button
                                                                class="btn text-primary fw-bold w-100 d-block text-start"
                                                                id="resetStatus">
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
                                    <div>
                                        {!! $dataTable->table([
                                            'class' => 'table table-striped nowrap align-middle',
                                            'style' => 'width:100%;',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('components.lib.modal-img')
            </div>
        </div>
    @endsection

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

        <script src="{{ asset('assets/js/filter-agenda.js') }}"></script>
    @endpush
