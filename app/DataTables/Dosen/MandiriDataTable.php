<?php

namespace App\DataTables\Dosen;

use App\Models\MhsKegiatan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MandiriDataTable extends DataTable
{
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('sertifikat', function ($item) {
                if (pathinfo($item->sertifikat, PATHINFO_EXTENSION) == 'pdf') {
                    return '<a href="' . asset('storage/' . $item->sertifikat) . '" class="btn btn-sm btn-primary" target="_blank">Lihat Berkas</a>';
                } else {
                    return '<img src="' . asset('storage/' . $item->sertifikat) . '" class="rounded image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item->sertifikat) . '" style="width: 64px; height: 40px; cursor: pointer; object-fit: cover;">';
                }
            })               
            ->editColumn('undangan', function ($item) {
                if (pathinfo($item->undangan, PATHINFO_EXTENSION) == 'pdf') {
                    return '<a href="' . asset('storage/' . $item->undangan) . '" class="btn btn-sm btn-primary" target="_blank">Lihat Berkas</a>';
                } else {
                    return '<img src="' . asset('storage/' . $item->undangan) . '" class="rounded image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item->sertifikat) . '" style="width: 64px; height: 40px; cursor: pointer; object-fit: cover;">';
                }
            })               
            ->editColumn('foto', function ($item) {
                return '<img src="' . asset('storage/' . $item['foto']) . '" class="rounded image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item['foto']) . '" style="width: 64px; height: 40px; cursor: pointer; object-fit: cover;">';
            })
            ->rawColumns(['sertifikat', 'foto', 'undangan']);
    }

    public function query(MhsKegiatan $model)
    {
        $query = $model->newQuery()
        ->with(['mahasiswa.prodi', 'mahasiswa.jalur', 'tingkat', 'jenis'])
        ->select([
            'mhs_kegiatan.*',
            'mhs_kegiatan.id as kegiatan_id',
        ]);

        if ($this->user_id) {
            $query->whereHas('mahasiswa', function ($subquery) {
                $subquery->where('user_id', $this->user_id);
            });
        }

        $angkatan = request('angkatan');
        $prodi = request('prodi');
        $tingkat = request('tingkat');
        $jenis = request('jenis');

        if ($angkatan) {
            $query->whereHas('mahasiswa', function ($subquery) use ($angkatan) {
                $subquery->where('tahun_masuk', $angkatan);
            });
        }

        if ($prodi) {
            $query->whereHas('mahasiswa', function ($subquery) use ($prodi) {
                $subquery->where('id_prodi', $prodi);
            });
        }

        if ($tingkat) {
            $query->where('id_kegiatan', $tingkat);
        }

        if ($jenis) {
            $query->where('id_jenis', $jenis);
        }

        return $query;
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('mandiri-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->scrollX(true)
            ->responsive(true)
            ->autoWidth(true)
            ->orderBy(0) 
            ->selectStyleSingle()
            ->buttons([
                'excel', 'csv', 'pdf', 'print', 'reset', 'reload'
            ])
            ->initComplete('function(settings, json) {
                $(".dataTables_wrapper").addClass("mb-3");
                $(".dataTables_filter").addClass("mb-2");
                $(".dataTables_length").addClass("mb-2");
                $(".dataTables_paginate").addClass("mt-3");
                $(".dataTables_info").addClass("mt-3");
            }');
    }

    protected function getColumns()
    {
        $columns = [
            Column::make('DT_RowIndex')->title('No.')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('mahasiswa.nim')->title('NIM'),
            Column::make('mahasiswa.nama')->title('Nama Mahasiswa'),
            Column::make('mahasiswa.prodi.nama')->title('Prodi'),
            Column::make('mahasiswa.tahun_masuk')->title('Angkatan'),
            Column::make('tingkat.nama')->title('Tingkat'),
            Column::make('jenis.nama')->title('Jenis Kepesertaan'),
            Column::make('nama')->title('Nama Kegiatan'),
            Column::make('penyelenggara')->title('Penyelenggara'),
            Column::make('jumlah')->title('Jumlah Peserta'),
            Column::make('tanggal_mulai')->title('Tanggal Mulai'),
            Column::make('tanggal_selesai')->title('Tanggal Selesai'),
            Column::make('url_penyelenggara')->title('URL Penyelenggara'),
            Column::computed('sertifikat')
                ->title('Sertifikat')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false),
            Column::computed('foto')
                ->title('Foto')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false),
            Column::computed('undangan')
                ->title('Surat Tugas / Undangan')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('url_penyelenggara')->title('URL Penyelenggara'),
        ];

        if ($this->user_id) {
            $columns = array_filter($columns, function ($column) {
                return !in_array($column->name, ['mahasiswa.nim', 'mahasiswa.nama']);
            });
        }
        return $columns;
    }

    protected function filename(): string
    {
        return 'Mandiri_' . date('YmdHis');
    }
}
