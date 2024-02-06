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
                                    <div>
                                        <h5>Data Agenda</h5>
                                        <p class="card-title-desc">Tabel ini berisi seluruh kegiatan agenda yang
                                            ditambahkan oleh mahasiswa.
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
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
                                        <div class="col-md-3">
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
                                        <div class="col-md-3">
                                            <div class="mb-2">
                                                <label for="filter-bimbingan">Bimbingan</label>
                                                <select id="filter-bimbingan" class="form-select">
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($jenis_bimbingan as $value => $label)
                                                        <option value="{{ $value }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-2">
                                                <label for="filter-status-agenda">Status</label>
                                                <select id="filter-status-agenda" class="form-select">
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($status as $value => $label)
                                                        <option value="{{ $value }}">{{ $label }}</option>
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
        <script>
            const table = $('#agenda-table');
            table.on('preXhr.dt', function(e, settings, data) {
                data.angkatan = $('#filter-angkatan').val();
                data.prodi = $('#filter-prodi').val();
                data.bimbingan = $('#filter-bimbingan').val();
                data.status = $('#filter-status-agenda').val();
            });

            $('#filter-angkatan, #filter-prodi, #filter-bimbingan, #filter-status-agenda').on('change', function() {
                table.DataTable().ajax.reload();
            });
        </script>
    @endpush
