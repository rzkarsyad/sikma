@extends('layouts.main')
@section('title')
    Agenda Mahasiswa
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Agenda Mahasiswa</h4>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Agenda</h4>
                                    <p class="card-title-desc">Tabel ini berisi seluruh kegiatan agenda yang
                                        ditambahkan oleh mahasiswa.
                                    </p>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div id="filter-angkatan" class="mb-2">
                                                <label for="angkatan">Angkatan</label>
                                                <select id="angkatan" class="form-select">
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($angkatan as $angkatan)
                                                        <option value="{{ $angkatan }}">{{ $angkatan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div id="filter-prodi" class="mb-2">
                                                <label for="prodi">Program Studi</label>
                                                <select id="prodi" class="form-select">
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($prodi as $prodi)
                                                        <option value="{{ $prodi }}">{{ $prodi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div id="filter-bimbingan" class="mb-2">
                                                <label for="bimbingan">Bimbingan</label>
                                                <select id="filter-bimbingan" class="form-select">
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($jenis_bimbingan as $bimbingan)
                                                        <option value="{{ $bimbingan }}">{{ $bimbingan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div id="filter-status" class="mb-2">
                                                <label for="status">Status</label>
                                                <select id="filter-status" class="form-select">
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($status as $status)
                                                        <option value="{{ $status }}">{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mt-4">
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
                <!-- end page title -->
            </div>
        </div>

        @include('components.lib.modal-img')
    @endsection

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
