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

                                    {{-- <table id="example" class="table dt-responsive table-striped nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Detail</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Institusi</th>
                                                <th>Fakultas</th>
                                                <th>Program Studi</th>
                                                <th>Jalur Masuk</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tanggal Lahir</th>
                                                <th>No. HP</th>
                                                <th>Email Kampus</th>
                                                <th>Alamat</th>
                                                <th>Tahun Masuk</th>
                                                <th>Nama Ortu</th>
                                                <th>Hubungan Ortu</th>
                                                <th>No. HP Ortu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($mahasiswa as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a href="{{ route('dosen.show.mahasiswa', ['id' => $item->id]) }}"
                                                            class="btn btn-primary btn-sm"><i class="ri-eye-line"></i></a>
                                                    </td>
                                                    <td>{{ $item->nim }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->institusi }}</td>
                                                    <td>{{ $item->prodi->fakultas->nama }}</td>
                                                    <td>{{ $item->prodi->nama }}</td>
                                                    <td>{{ $item->jalur->nama }}</td>
                                                    <td>
                                                        @if ($item->jns_kelamin == 'L')
                                                            Laki-laki
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </td>
                                                    </td>
                                                    <td>{{ $item->tempat_lahir }}</td>
                                                    <td>{{ $item->tgl_lahir }}</td>
                                                    <td>{{ $item->no_hp }}</td>
                                                    <td>{{ $item->email_kampus }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td>{{ $item->tahun_masuk }}</td>
                                                    <td>{{ $item->nama_ortu }}</td>
                                                    <td>{{ $item->hubungan_ortu }}</td>
                                                    <td>{{ $item->no_hp_ortu }}</td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table> --}}

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
