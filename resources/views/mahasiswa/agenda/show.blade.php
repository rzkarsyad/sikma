@extends('layouts.main')
@section('title')
    Detail | {{ $mhsAgenda->topic }}
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Detail Agenda</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ url()->previous() }}" class="text-dark">
                                        <i class="ri-arrow-left-line font-size-24"></i>
                                    </a>
                                    <h4 class="ms-2 my-auto w-100 overflow-hidden" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{ $mhsAgenda->topic }}">
                                        {!! strlen($mhsAgenda->topic) > 100 ? substr($mhsAgenda->topic, 0, 100) . '...' : $mhsAgenda->topic !!}
                                    </h4>
                                </div>
                                <div>
                                    <span class="badge rounded-pill {{ $badgeClass }}">{{ $statusText }}</span>
                                </div>
                            </div>


                            <table class="table table-bordered">
                                <tr>
                                    <td style="width: 22%">Jenis Bimbingan</td>
                                    <td>{{ $mhsAgenda->type->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>{{ $mhsAgenda->agenda_date }}</td>
                                </tr>
                                <tr>
                                    <td>Waktu</td>
                                    <td>{{ $mhsAgenda->agenda_time }}</td>
                                </tr>
                                <tr>
                                    <td>Dosen Pembimbing</td>
                                    <td>{{ $mhsAgenda->dosen->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Judul</td>
                                    <td>{{ $mhsAgenda->topic }}</td>
                                </tr>
                                <tr>
                                    <td>Isi</td>
                                    <td>{{ $mhsAgenda->content }}</td>
                                </tr>
                            </table>

                            <h5>Tanggapan</h5>

                            <table class="table table-bordered mt-3">
                                <tr>
                                    <td style="width: 22%">Hasil</td>
                                    <td>{{ $mhsAgenda->result }}</td>
                                </tr>
                                <tr>
                                    <td>Tindak Lanjut</td>
                                    <td>{{ $mhsAgenda->action }}</td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
