<?php

namespace App\DataTables\Dosen;

use App\Models\MhsAktivitas;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AktivitasDataTable extends DataTable
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
            ->editColumn('foto', function ($item) {
                return '<img src="' . asset('storage/' . $item['foto']) . '" class="rounded image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item['foto']) . '" style="width: 64px; height: 40px; cursor: pointer; object-fit: cover;">';
            })
            ->rawColumns(['sertifikat', 'foto']);
    }

    public function query(MhsAktivitas $model)
    {
        $query = $model->newQuery()
        ->with(['mahasiswa.prodi', 'kegiatan', 'kategori'])
        ->select([
            'mhs_aktivitas.*',
            'mhs_aktivitas.id as aktivitas_id',
        ]);

        if ($this->user_id) {
            $query->whereHas('mahasiswa', function ($subquery) {
                $subquery->where('user_id', $this->user_id);
            });
        }

        $angkatan = request('angkatan');
        $prodi = request('prodi');
        $kegiatan = request('kegiatan');
        $kategori = request('kategori');
        $tahun = request('tahun');

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

        if ($kegiatan) {
            $query->where('id_aktivitas', $kegiatan);
        }
        
        if ($kategori) {
            $query->where('id_kategori', $kategori);
        }

        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        return $query;
    }
    
    public function html()
    {
        return $this->builder()
            ->setTableId('aktivitas-table')
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
            Column::make('mahasiswa.prodi.nama')->title('Program Studi'),
            Column::make('mahasiswa.tahun_masuk')->title('Angkatan'),
            Column::make('kegiatan.nama')->title('Nama Kegiatan'),
            Column::make('kategori.nama')->title('Tingkat'),
            Column::make('tahun')->title('Tahun'),
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
        return 'Aktivitas_' . date('YmdHis');
    }
}
