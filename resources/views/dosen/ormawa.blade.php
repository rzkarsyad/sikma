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
                        <h4 class="mb-sm-0">Kegiatan Organisasi Mahasiswa</h4>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <h5>Data Ormawa & UKM</h5>
                                        <p class="card-title-desc">Tabel ini berisi seluruh ormawa dan UKM yang
                                            diikuti oleh mahasiswa.
                                        </p>
                                    </div>
                                    <div class="row align-items-end">
                                        <div class="col-md-2">
                                            <div class="mb-2">
                                                <label for="filter-angkatan">Angkatan</label>
                                                <select id="filter-angkatan" class="form-select">
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($angkatan as $angkatan)
                                                        <option value="{{ $angkatan }}">{{ $angkatan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-2">
                                                <label for="filter-prodi">Program Studi</label>
                                                <select id="filter-prodi" class="form-select">
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($prodi as $id => $nama)
                                                        <option value="{{ $id }}">{{ $nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-2">
                                                <label for="filter-ormawa">Jenis Ormawa</label>
                                                <select id="filter-ormawa" class="form-select">
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($ormawa as $id => $nama)
                                                        <option value="{{ $id }}">{{ $nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="mb-2">
                                                <button id="btnReset" class="btn btn-primary px-3">Reset Filter</button>
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

    <script>
        const table = $('#ormawa-table');
        table.on('preXhr.dt', function(e, settings, data) {
            data.angkatan = $('#filter-angkatan').val();
            data.prodi = $('#filter-prodi').val();
            data.ormawa = $('#filter-ormawa').val();
        });

        $('#filter-angkatan, #filter-prodi, #filter-ormawa').on('change', function() {
            table.DataTable().ajax.reload();
        });

        $('#btnReset').on('click', function() {
            $('#filter-angkatan, #filter-prodi, #filter-ormawa').val('');
            table.DataTable().ajax.reload();
        });
    </script>
@endpush
