@extends('layouts.main')
@section('title')
    Ormawa & UKM
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Kegiatan Organisasi dan UKM Mahasiswa</h4>
                        <a href="{{ route('m.ormawa-create') }}" class="btn btn-primary">+ Tambah Kegiatan</a>
                    </div>

                    @include('components.lib.toast-success')

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Kegiatan Ormawa & UKM</h4>
                                    <p class="card-title-desc">Tabel ini berisi seluruh kegiatan organisasi dan UKM yang
                                        diikuti oleh mahasiswa.
                                    </p>
                                    {!! $dataTable->table([
                                        'class' => 'table table-striped nowrap',
                                        'style' => 'width:100%;',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.lib.modal-img')
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
