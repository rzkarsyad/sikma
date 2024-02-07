@extends('layouts.main')
@section('title')
    Organisasi Mahasiswa
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Organisasi</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('m.ormawa-update', $mhsOrmawa->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row gx-3 gy-2 align-items-center">
                                    <div class="col-md-6 mt-3">
                                        <label for="list_ormawa">Jenis Organisasi</label>
                                        <select name="id_jenis_ormawa"
                                            class="form-select @error('id_jenis_ormawa') is-invalid @enderror">
                                            <option value="">Pilih Jenis Organisasi</option>
                                            @foreach ($ormawa as $id => $nama)
                                                <option value="{{ $id }}"
                                                    {{ $id == $mhsOrmawa->id_jenis_ormawa ? 'selected' : null }}>
                                                    {{ $nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_jenis_ormawa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="jabatan">Jabatan</label>
                                        <input name="jabatan" type="text" value="{{ $mhsOrmawa->jabatan }}"
                                            class="form-control @error('jabatan') is-invalid @enderror" id="jabatan">
                                        @error('jabatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="nama_ormawa">Nama Organisasi</label>
                                        <input name="nama_ormawa" type="text" value="{{ $mhsOrmawa->nama_ormawa }}"
                                            class="form-control @error('nama_ormawa') is-invalid @enderror"
                                            id="nama_ormawa">
                                        @error('nama_ormawa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="masa_jabatan">Masa Jabatan</label>
                                        <input name="masa_jabatan" type="text" value="{{ $mhsOrmawa->masa_jabatan }}"
                                            class="form-control @error('masa_jabatan') is-invalid @enderror"
                                            id="masa_jabatan">
                                        @error('masa_jabatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="url_media_ormawa">URL Media Ormawa</label>
                                        <input name="url_media_ormawa" type="text"
                                            value="{{ $mhsOrmawa->url_media_ormawa }}"
                                            class="form-control @error('url_media_ormawa') is-invalid @enderror"
                                            id="url_media_ormawa">
                                        @error('url_media_ormawa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label for="sk" class="form-label">SK Kepengurusan</label>
                                        <table>
                                            <tr>
                                                <td>
                                                    @if ($mhsOrmawa->sk)
                                                        @if (pathinfo($mhsOrmawa->sk, PATHINFO_EXTENSION) == 'pdf')
                                                            <a href="{{ asset('storage/' . $mhsOrmawa->sk) }}"
                                                                class="btn btn-sm btn-primary mb-2" target="_blank">Lihat
                                                                Berkas</a>
                                                        @else
                                                            <img src="{{ asset('storage/' . $mhsOrmawa->sk) }}"
                                                                class="rounded image-clickable" data-bs-toggle="modal"
                                                                data-bs-target="#myModal"
                                                                data-image="{{ asset('storage/' . $mhsOrmawa->sk) }}"
                                                                style="width: 64px; height: 40px; cursor: pointer; object-fit: cover;">
                                                        @endif
                                                    @else
                                                        <span class="badge badge-danger">Belum ada SK</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                        <br>
                                        <input name="sk" class="form-control @error('sk') is-invalid @enderror"
                                            type="file" id="sk">
                                        @error('sk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-auto mt-4">
                                        <a href="{{ route('m.ormawa') }}" class="btn btn-outline-primary px-3">Batal</a>
                                        <button class="btn btn-primary ms-2 waves-effect px-3"
                                            type="submit">Simpan</button>
                                    </div>
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
