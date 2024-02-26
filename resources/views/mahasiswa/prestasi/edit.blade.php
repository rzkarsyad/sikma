@extends('layouts.main')
@section('title')
    Prestasi
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Prestasi</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('m.prestasi-update', $mhsPrestasi->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row gx-3 gy-2 align-items-center">
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="list_tingkat">Tingkat Kegiatan</label>
                                            <select name="id_kegiatan"
                                                class="form-select @error('id_kegiatan') is-invalid @enderror">
                                                <option value="">Pilih Tingkat</option>
                                                @foreach ($tingkat as $id => $nama)
                                                    <option value="{{ $id }}"
                                                        {{ $id == $mhsPrestasi->id_kegiatan ? 'selected' : null }}>
                                                        {{ $nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_kegiatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama">Nama Kegiatan</label>
                                            <input name="nama" type="text" value="{{ $mhsPrestasi->nama }}"
                                                class="form-control @error('nama') is-invalid @enderror" id="nama">
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="penyelenggara">Penyelenggara</label>
                                            <input name="penyelenggara" type="text"
                                                value="{{ $mhsPrestasi->penyelenggara }}"
                                                class="form-control @error('penyelenggara') is-invalid @enderror"
                                                id="penyelenggara">
                                            @error('penyelenggara')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="jumlah">Jumlah Peserta</label>
                                            <input name="jumlah" type="text" value="{{ $mhsPrestasi->jumlah }}"
                                                class="form-control @error('jumlah') is-invalid @enderror" id="jumlah">
                                            @error('jumlah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="capaian">Capaian</label>
                                            <input name="capaian" type="text" value="{{ $mhsPrestasi->capaian }}"
                                                class="form-control @error('capaian') is-invalid @enderror" id="capaian">
                                            @error('capaian')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="url_penyelenggara">URL Penyelenggara</label>
                                            <input name="url_penyelenggara" type="text"
                                                value="{{ $mhsPrestasi->url_penyelenggara }}"
                                                class="form-control @error('url_penyelenggara') is-invalid @enderror"
                                                id="url_penyelenggara">
                                            @error('url_penyelenggara')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_mulai">Tanggal Mulai Pelaksanaan</label>
                                            <input name="tanggal_mulai" type="date"
                                                value="{{ $mhsPrestasi->tanggal_mulai }}"
                                                class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                                id="tanggal_mulai">
                                            @error('tanggal_mulai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_selesai">Tanggal Selesai Pelaksanaan</label>
                                            <input name="tanggal_selesai" type="date"
                                                value="{{ $mhsPrestasi->tanggal_selesai }}"
                                                class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                                id="tanggal_selesai">
                                            @error('tanggal_selesai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row gx-3 gy-2 mb-3">
                                        <div class="col-md">
                                            <div class="mb-3">
                                                <label for="tropi" class="form-label">Sertifikat/Foto
                                                    Medali/Piala</label>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            @if ($mhsPrestasi->tropi)
                                                                @if (pathinfo($mhsPrestasi->tropi, PATHINFO_EXTENSION) == 'pdf')
                                                                    <a href="{{ asset('storage/' . $mhsPrestasi->tropi) }}"
                                                                        class="btn btn-sm btn-primary mb-2"
                                                                        target="_blank">Lihat
                                                                        Berkas</a>
                                                                @else
                                                                    @include(
                                                                        'components.lib.img-thumbnail',
                                                                        [
                                                                            'thumb_path' => $mhsPrestasi->tropi,
                                                                        ]
                                                                    )
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">Belum ada SK</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                                <br>
                                                <input name="tropi"
                                                    class="form-control @error('tropi') is-invalid @enderror" type="file"
                                                    id="tropi">
                                                @error('tropi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="mb-3">
                                                <label for="foto" class="form-label">Foto</label>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            @if ($mhsPrestasi->foto)
                                                                @include('components.lib.img-thumbnail', [
                                                                    'thumb_path' => $mhsPrestasi->foto,
                                                                ])
                                                            @else
                                                                <span class="badge badge-danger">Belum ada foto</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                                <br>
                                                <input name="foto"
                                                    class="form-control @error('foto') is-invalid @enderror" type="file"
                                                    id="foto" accept="image/*">
                                                @error('foto')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="mb-3">
                                                <label for="undangan" class="form-label">Surat Tugas/Undangan</label>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            @if ($mhsPrestasi->undangan)
                                                                @if (pathinfo($mhsPrestasi->undangan, PATHINFO_EXTENSION) == 'pdf')
                                                                    <a href="{{ asset('storage/' . $mhsPrestasi->undangan) }}"
                                                                        class="btn btn-sm btn-primary mb-2"
                                                                        target="_blank">Lihat
                                                                        Berkas</a>
                                                                @else
                                                                    @include(
                                                                        'components.lib.img-thumbnail',
                                                                        [
                                                                            'thumb_path' => $mhsPrestasi->undangan,
                                                                        ]
                                                                    )
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">Belum ada SK</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                                <br>
                                                <input name="undangan"
                                                    class="form-control @error('undangan') is-invalid @enderror"
                                                    type="file" id="undangan">
                                                @error('undangan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
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
    @include('components.lib.modal-img')
    <script src="{{ asset('assets/js/min-date.js') }}"></script>
@endsection
