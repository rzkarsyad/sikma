@extends('layouts.main')
@section('title')
    {{ $mahasiswa->nama }}
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Detail Mahasiswa</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url()->previous() }}"
                                class="btn bg-white text-dark waves-effect waves-light shadow mb-3">
                                <i class="ri-arrow-left-line"></i>
                                Kembali
                            </a>
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <h4>{{ $mahasiswa->nama }}</h4>
                                        <p class="text-muted">{{ $mahasiswa->nim }} | {{ $mahasiswa->prodi->nama }}</p>
                                    </div>
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#profil" role="tab">
                                                <span class="d-block d-sm-none"><i class="ri-user-line"></i></span>
                                                <span class="d-none d-sm-block">Profil</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#agenda" role="tab">
                                                <span class="d-block d-sm-none"><i class="ri-file-list-2-line"></i></span>
                                                <span class="d-none d-sm-block">Agenda</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#aktivitas" role="tab">
                                                <span class="d-block d-sm-none"><i class="ri-file-list-2-line"></i></span>
                                                <span class="d-none d-sm-block">Aktivitas</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#mandiri" role="tab">
                                                <span class="d-block d-sm-none"><i class="ri-book-line"></i></span>
                                                <span class="d-none d-sm-block">Kegiatan Mandiri</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#prestasi" role="tab">
                                                <span class="d-block d-sm-none"><i class="ri-trophy-line"></i></i></span>
                                                <span class="d-none d-sm-block">Prestasi</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#ormawa" role="tab">
                                                <span class="d-block d-sm-none"><i class="ri-team-line"></i></span>
                                                <span class="d-none d-sm-block">Kegiatan Ormawa</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content p-3 text-muted">
                                        <div class="tab-pane active" id="profil" role="tabpanel">
                                            <div class="col-8">
                                                <h5>Data Mahasiswa</h5>
                                                <table class="table mt-3 table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <td align="left">NIM</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->nim }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">Nama</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">Institusi</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->institusi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">Fakultas</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->prodi->fakultas->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">Program Studi</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->prodi->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">Jalur Masuk</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->jalur->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">Jenis Kelamin</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">
                                                                @if ($mahasiswa->jns_kelamin == 'L')
                                                                    Laki-laki
                                                                @else
                                                                    Perempuan
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">Tempat Lahir</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->tempat_lahir }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">Tanggal Lahir</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->tgl_lahir }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">No. HP</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->no_hp }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">Email</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">Alamat</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->alamat }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">Tahun Masuk</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->tahun_masuk }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">Nama Orang Tua</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->nama_ortu }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">Hubungan Orang Tua</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->hubungan_ortu }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">No. HP Orang Tua</td>
                                                            <td width="2px">:</td>
                                                            <td align="left">{{ $mahasiswa->no_hp_ortu }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="aktivitas" role="tabpanel">
                                            <h5 class="mb-4">Data Aktivitas</h5>
                                            {!! $dataTable->table(['class' => 'table dt-responsive nowrap align-middle', 'style' => 'width:100%;']) !!}
                                        </div>
                                        <div class="tab-pane" id="agenda" role="tabpanel">
                                            <h5 class="mb-4">Data Agenda</h5>
                                            <table id="tb-agenda" class="table dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Jenis Bimbingan</th>
                                                        <th>Topik</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($mahasiswa->agenda as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            @if ($item->type == 1)
                                                                <td>Bimbingan Konseling</td>
                                                            @elseif ($item->type == 2)
                                                                <td>Bimbingan Pembina Ormawa</td>
                                                            @endif
                                                            <td>{{ $item->topic }}</td>
                                                            <td>{{ $item->agenda_date }}</td>
                                                            @if ($item->status == 1)
                                                                <td>
                                                                    <span class="badge text-bg-danger">Belum
                                                                        diterima</span>
                                                                </td>
                                                            @elseif ($item->status == 2)
                                                                <td>
                                                                    <span class="badge text-bg-success">
                                                                        diterima</span>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="mandiri" role="tabpanel">
                                            <h5 class="mb-4">Data Kegiatan Mandiri</h5>
                                            <table id="tb-kegiatan" class="table dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kategori Kegiatan</th>
                                                        <th>Jenis Kepesertaan</th>
                                                        <th>Nama Kegiatan</th>
                                                        <th>Penyelenggara</th>
                                                        <th>Jumlah Peserta</th>
                                                        <th>Tanggal Mulai</th>
                                                        <th>Tanggal Selesai</th>
                                                        <th>URL Penyelenggara</th>
                                                        <th>Sertifikat</th>
                                                        <th>Foto</th>
                                                        <th>Surat Tugas/Undangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($mahasiswa->kegiatan as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->tingkat->nama }}</td>
                                                            <td>{{ $item->jenis->nama }}</td>
                                                            <td>{{ $item->nama }}</td>
                                                            <td>{{ $item->penyelenggara }}</td>
                                                            <td>{{ $item->jumlah }}</td>
                                                            <td>{{ $item->tanggal_mulai }}</td>
                                                            <td>{{ $item->tanggal_selesai }}</td>
                                                            <td>{{ $item->url_penyelenggara }}</td>
                                                            <td>
                                                                @if (pathinfo($item->sertifikat, PATHINFO_EXTENSION) == 'pdf')
                                                                    <!-- Display a button to download PDF -->
                                                                    <a href="{{ asset('storage/' . $item->sertifikat) }}"
                                                                        class="btn btn-primary" download>Download PDF</a>
                                                                @else
                                                                    <img src="{{ asset('storage/' . $item->sertifikat) }}"
                                                                        class="rounded image-clickable"
                                                                        data-bs-toggle="modal" data-bs-target="#myModal"
                                                                        data-image="{{ asset('storage/' . $item->sertifikat) }}"
                                                                        style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <img src="{{ asset('storage/' . $item->foto) }}"
                                                                    class="rounded image-clickable" data-bs-toggle="modal"
                                                                    data-bs-target="#myModal"
                                                                    data-image="{{ asset('storage/' . $item->foto) }}"
                                                                    style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
                                                            </td>
                                                            <td>
                                                                @if (pathinfo($item->undangan, PATHINFO_EXTENSION) == 'pdf')
                                                                    <!-- Display a button to download PDF -->
                                                                    <a href="{{ asset('storage/' . $item->undangan) }}"
                                                                        class="btn btn-primary" download>Download PDF</a>
                                                                @else
                                                                    <img src="{{ asset('storage/' . $item->undangan) }}"
                                                                        class="rounded image-clickable"
                                                                        data-bs-toggle="modal" data-bs-target="#myModal"
                                                                        data-image="{{ asset('storage/' . $item->undangan) }}"
                                                                        style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="prestasi" role="tabpanel">
                                            <h5 class="mb-4">Data Prestasi</h5>
                                            <table id="tb-prestasi" class="table dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tingkat</th>
                                                        <th>Nama Kegiatan</th>
                                                        <th>Penyelenggara</th>
                                                        <th>Jumlah Peserta</th>
                                                        <th>Capaian</th>
                                                        <th>Tgl Mulai</th>
                                                        <th>Tgl Selesai</th>
                                                        <th>URL Penyelenggara</th>
                                                        <th>Tropi</th>
                                                        <th>Foto</th>
                                                        <th>Surat Undangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($mahasiswa->prestasi as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->tingkat->nama }}</td>
                                                            <td>{{ $item->nama }}</td>
                                                            <td>{{ $item->penyelenggara }}</td>
                                                            <td>{{ $item->jumlah }}</td>
                                                            <td>{{ $item->capaian }}</td>
                                                            <td>{{ $item->tanggal_mulai }}</td>
                                                            <td>{{ $item->tanggal_selesai }}</td>
                                                            <td>{{ $item->url_penyelenggara }}</td>
                                                            <td>
                                                                @if (pathinfo($item->tropi, PATHINFO_EXTENSION) == 'pdf')
                                                                    <!-- Display a button to download PDF -->
                                                                    <a href="{{ asset('storage/' . $item->tropi) }}"
                                                                        class="btn btn-primary" download>Download PDF</a>
                                                                @else
                                                                    <img src="{{ asset('storage/' . $item->tropi) }}"
                                                                        class="rounded image-clickable"
                                                                        data-bs-toggle="modal" data-bs-target="#myModal"
                                                                        data-image="{{ asset('storage/' . $item->tropi) }}"
                                                                        style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <img src="{{ asset('storage/' . $item->foto) }}"
                                                                    class="rounded image-clickable" data-bs-toggle="modal"
                                                                    data-bs-target="#myModal"
                                                                    data-image="{{ asset('storage/' . $item->foto) }}"
                                                                    style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
                                                            </td>
                                                            <td>
                                                                @if (pathinfo($item->undangan, PATHINFO_EXTENSION) == 'pdf')
                                                                    <!-- Display a button to download PDF -->
                                                                    <a href="{{ asset('storage/' . $item->undangan) }}"
                                                                        class="btn btn-primary" download>Download PDF</a>
                                                                @else
                                                                    <img src="{{ asset('storage/' . $item->undangan) }}"
                                                                        class="rounded image-clickable"
                                                                        data-bs-toggle="modal" data-bs-target="#myModal"
                                                                        data-image="{{ asset('storage/' . $item->undangan) }}"
                                                                        style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="ormawa" role="tabpanel">
                                            <h5 class="mb-4">Data Ormawa</h5>
                                            <table id="tb-ormawa" class="table dt-responsive nowrap" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Jenis Organisasi</th>
                                                        <th>Nama Organisasi</th>
                                                        <th>Jabatan</th>
                                                        <th>Masa Jabatan</th>
                                                        <th>URL Sosial Media Ormawa</th>
                                                        <th>SK Kepengurusan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($mahasiswa->ormawa as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->ormawa->nama }}</td>
                                                            <td>{{ $item->nama_ormawa }}</td>
                                                            <td>{{ $item->jabatan }}</td>
                                                            <td>{{ $item->masa_jabatan }}</td>
                                                            <td>{{ $item->url_media_ormawa }}</td>
                                                            <td>
                                                                @if (pathinfo($item->sk, PATHINFO_EXTENSION) == 'pdf')
                                                                    <!-- Display a button to download PDF -->
                                                                    <a href="{{ asset('storage/' . $item->sk) }}"
                                                                        class="btn btn-primary" download>Download PDF</a>
                                                                @else
                                                                    <img src="{{ asset('storage/' . $item->sk) }}"
                                                                        class="rounded image-clickable"
                                                                        data-bs-toggle="modal" data-bs-target="#myModal"
                                                                        data-image="{{ asset('storage/' . $item->sk) }}"
                                                                        style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Lihat Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    </script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
