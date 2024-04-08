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
                        <a href="{{ route('m.agenda-create') }}" class="btn btn-primary">+ Tambah Agenda</a>
                    </div>

                    @include('components.lib.toast-success')

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Agenda</h4>
                                    <p class="card-title-desc">Tabel ini berisi seluruh agenda yang telah dilakukan oleh
                                        mahasiswa</p>
                                    {!! $dataTable->table([
                                        'class' => 'table table-striped overflow-auto nowrap',
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
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
