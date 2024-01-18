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
                                    {!! $dataTable->table([
                                        'class' => 'table table-striped nowrap',
                                        'style' => 'width:100%;',
                                    ]) !!}
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
@endpush
