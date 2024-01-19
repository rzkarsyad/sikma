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
                                    <div class="col d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card-title">Data Aktivitas</h4>
                                            <p class="card-title-desc">Tabel ini berisi seluruh kegiatan aktivitas dari
                                                kampus yang diikuti oleh mahasiswa.</p>
                                        </div>
                                    </div>

                                    {!! $dataTable->table(['class' => 'table dt-responsive nowrap']) !!}

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
@endpush
