@extends('layouts.main')
@section('title')
    Detail | {{ $mhsAgenda->topic }}
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Detail Agenda</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('dosen.agenda.update', $mhsAgenda->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="d-flex justify-content-between mb-3">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="javascript:history.back()" class="text-dark">
                                            <i class="ri-arrow-left-line font-size-24"></i>
                                        </a>
                                        <h4 class="ms-2 my-auto w-100 overflow-hidden" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="{{ $mhsAgenda->topic }}">
                                            {!! strlen($mhsAgenda->topic) > 100 ? substr($mhsAgenda->topic, 0, 100) . '...' : $mhsAgenda->topic !!}
                                        </h4>
                                        <span class="ms-2 badge rounded-pill {{ $badgeClass }}">{{ $statusText }}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md">
                                        <table class="table">
                                            <tr>
                                                <td style="width: 32%" class="text-primary fw-bold">Mahasiswa</td>
                                                <td>{{ $mahasiswa->nim }} - {{ $mahasiswa->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 32%" class="text-primary fw-bold">Pembimbing</td>
                                                <td>{{ $dosen->nidn }} - {{ $dosen->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 32%" class="text-primary fw-bold">Jenis Bimbingan</td>
                                                <td>{{ $type }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md">
                                        <table class="table">
                                            <tr>
                                                <td style="width: 32%" class="text-primary fw-bold">Tanggal</td>
                                                <td>{{ $agendaDate }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 32%" class="text-primary fw-bold">Waktu</td>
                                                <td>{{ $mhsAgenda->agenda_time }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 32%" class="text-primary fw-bold">Topik</td>
                                                <td>{{ $mhsAgenda->topic }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-10">
                                    <table class="table">
                                        <tr>
                                            <td style="width: 19%" class="text-primary fw-bold">Pembahasan</td>
                                            <td>{{ $mhsAgenda->content }}</td>
                                        </tr>
                                    </table>
                                </div>

                                @if ($mhsAgenda->status == 2)
                                    <h5 class="mt-4">Tanggapan Anda</h5>
                                    <table class="table mt-4">
                                        <tr>
                                            <td style="width: 16%" class="text-primary fw-bold">Hasil</td>
                                            <td>{{ $mhsAgenda->result }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-primary fw-bold">Tindak Lanjut</td>
                                            <td>{{ $mhsAgenda->action }}</td>
                                        </tr>
                                    </table>
                                @else
                                    <h5 class="mt-4">Berikan Tanggapan</h5>
                                    <div class="mb-3">
                                        <label for="result">Hasil</label>
                                        <textarea class="form-control @error('result') is-invalid @enderror" name="result" id="result" cols="30"
                                            rows="6" placeholder="Tulis pembahasan">{{ old('result') }}</textarea>
                                        @error('result')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="action">Tindak Lanjut</label>
                                        <textarea class="form-control @error('action') is-invalid @enderror" name="action" id="action" cols="30"
                                            rows="6" placeholder="Tulis pembahasan">{{ old('action') }}</textarea>
                                        @error('action')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <a href="{{ route('dosen.agenda') }}"
                                                    class="btn btn-outline-primary px-3">Batal</a>
                                                <button class="btn btn-primary ms-2 waves-effect px-3"
                                                    type="submit">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    </div>
@endsection
