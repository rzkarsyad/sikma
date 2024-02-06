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
                                    <div class="row">
                                        <div class="col-md">
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
                                        <div class="col-md">
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
                                        <div class="col-md">
                                            <div class="mb-2">
                                                <label for="filter-kategori">Tingkat</label>
                                                <select id="filter-kategori" class="form-select">
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($kategori as $id => $nama)
                                                        <option value="{{ $id }}">{{ $nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="mb-2">
                                                <label for="filter-tahun">Tahun</label>
                                                <select id="filter-tahun" class="form-select">
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($tahun as $thn)
                                                        <option value="{{ $thn }}">{{ $thn }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="mb-2">
                                                <label for="filter-kegiatan">Kegiatan</label>
                                                <select id="filter-kegiatan" class="form-select">
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($kegiatan as $id => $nama)
                                                        <option value="{{ $id }}">{{ $nama }}</option>
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
        const table = $('#aktivitas-table');
        table.on('preXhr.dt', function(e, settings, data) {
            data.angkatan = $('#filter-angkatan').val();
            data.prodi = $('#filter-prodi').val();
            data.kegiatan = $('#filter-kegiatan').val();
            data.kategori = $('#filter-kategori').val();
            data.tahun = $('#filter-tahun').val();
        });

        $('#filter-angkatan, #filter-prodi, #filter-kegiatan, #filter-kategori, #filter-tahun').on('change', function() {
            table.DataTable().ajax.reload();
        });
    </script>
@endpush
