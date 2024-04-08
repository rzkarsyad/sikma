@extends('layouts.main')
@section('title')
    Data Program Studi
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Data Program Studi</h4>
                    </div>

                    @include('components.lib.toast-success')

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col mb-4">
                                        <div
                                            class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                                            <div>
                                                <h4 class="card-title">Program Studi</h4>
                                                <p class="card-title-desc">Tabel ini berisi seluruh data program studi
                                                    Universitas Al-Irsyad Cilacap.</p>
                                            </div>
                                            <div class="d-flex mt-3 mt-md-0">
                                                <button type="button"
                                                    class="btn btn-primary mb-2 mb-md-0 me-2 waves-effect waves-light"
                                                    data-bs-toggle="modal" data-bs-target="#createModal"
                                                    data-bs-title="Add"> Tambah data
                                                </button>
                                            </div>
                                        </div>
                                        {!! $dataTable->table([
                                            'class' => 'table nowrap align-middle',
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
    </div>

    @include('components.lib.modals.modal-prodi')
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
