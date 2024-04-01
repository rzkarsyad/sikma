@extends('layouts.main')
@section('title')
    Prestasi
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Prestasi</h4>
                        <a href="{{ route('m.prestasi-create') }}" class="btn btn-primary">+ Tambah Prestasi</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Prestasi</h4>
                                    <p class="card-title-desc">Tabel ini berisi seluruh prestasi yang diperoleh mahasiswa.
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
