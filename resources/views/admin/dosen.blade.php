@extends('layouts.main')
@section('title')
    Data Dosen
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Data Dosen</h4>
                    </div>

                    @include('components.lib.toast')

                    @include('components.lib.toast-error')

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col mb-4">
                                        <div
                                            class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                            <div>
                                                <h4 class="card-title">Dosen</h4>
                                                <p class="card-title-desc">Tabel ini berisi seluruh data dosen
                                                    Universitas Al-Irsyad Cilacap.</p>
                                            </div>
                                            <div class="d-flex mt-3 mt-md-0">
                                                <a href="{{ route('admin.dosen.export') }}"
                                                    class="btn btn-outline-success mb-2 mb-md-0 me-2 waves-effect waves-light">
                                                    <i class="ri-file-download-line me-2 d-none d-md-inline"></i>Export
                                                </a>

                                                <button type="button"
                                                    class="btn btn-outline-primary mb-2 mb-md-0 me-2 waves-effect waves-light"
                                                    data-bs-toggle="modal" data-bs-target="#myModal">
                                                    <i class="ri-file-excel-2-line me-2 d-none d-md-inline"></i>Import
                                                </button>

                                                <a href="{{ route('admin.dosen.generate') }}"
                                                    class="btn btn-outline-secondary mb-2 mb-md-0 waves-effect waves-light">
                                                    <i class="ri-user-settings-line me-2 d-none d-md-inline"></i>Generate
                                                    User
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    {!! $dataTable->table(['class' => 'table dt-responsive nowrap', 'style' => 'width:100%;']) !!}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Import Data Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.dosen.import') }}" method="POST" enctype="multipart/form-data">
                        <p>Silahkan pilih file berupa .xlsx</p>
                        @csrf
                        <div class="mb-3">
                            <input class="form-control" type="file" id="formFile" name="file" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Import</button>
                </div>
                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
