@extends('layouts.main')
@section('title')
    Organisasi Mahasiswa
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Tambah Organisasi</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('m.ormawa-store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row gx-3 gy-2 align-items-center">
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="list_ormawa">Jenis Organisasi</label>
                                            <select name="id_jenis_ormawa"
                                                class="form-select @error('id_jenis_ormawa') is-invalid @enderror">
                                                <option value="">Pilih Jenis Organisasi</option>
                                                @foreach ($ormawa as $id => $nama)
                                                    <option value="{{ $id }}"
                                                        {{ old('id_jenis_ormawa') == $id ? 'selected' : null }}>
                                                        {{ $nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_jenis_ormawa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_ormawa">Nama Organisasi</label>
                                            <input name="nama_ormawa" type="text" value="{{ old('nama_ormawa') }}"
                                                class="form-control @error('nama_ormawa') is-invalid @enderror"
                                                id="nama_ormawa">
                                            @error('nama_ormawa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="url_media_ormawa">URL Media Ormawa</label>
                                            <input name="url_media_ormawa" type="text"
                                                value="{{ old('url_media_ormawa') }}"
                                                class="form-control @error('url_media_ormawa') is-invalid @enderror"
                                                id="url_media_ormawa">
                                            @error('url_media_ormawa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="jabatan">Jabatan</label>
                                            <input name="jabatan" type="text" value="{{ old('jabatan') }}"
                                                class="form-control @error('jabatan') is-invalid @enderror" id="jabatan">
                                            @error('jabatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="masa_jabatan">Masa Jabatan</label>
                                            <input name="masa_jabatan" type="text" value="{{ old('masa_jabatan') }}"
                                                class="form-control @error('masa_jabatan') is-invalid @enderror"
                                                id="masa_jabatan">
                                            @error('masa_jabatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="sk" class="form-label">SK Kepengurusan</label>
                                            <input name="sk" class="form-control @error('sk') is-invalid @enderror"
                                                type="file" id="sk">
                                            @error('sk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @include('components.lib.action-modal')
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>

    </div>
@endsection
