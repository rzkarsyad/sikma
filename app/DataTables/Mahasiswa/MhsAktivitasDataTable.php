<?php

namespace App\DataTables\Mahasiswa;

use App\Models\MhsAktivitas;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MhsAktivitasDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($item) {
                return view('mahasiswa.actions.mhs-aktivitas', compact('item'));
            })
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
        $id = auth()->user()->id;

        return $model->newQuery()
            ->where('user_id', $id)
            ->with(['kegiatan', 'kategori'])
            ->select([
                'mhs_aktivitas.*',
                'mhs_aktivitas.id as aktivitas_id',
            ]);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('mhsaktivitas-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->scrollX(true)
            ->responsive(true)
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
        return [
            Column::make('DT_RowIndex')->title('No.')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('kegiatan.nama')->title('Nama Kegiatan'),
            Column::make('kategori.nama')->title('Kategori'),
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
            Column::computed('actions')
            ->title('Aksi')
            ->orderable(false)
            ->searchable(false)
            ->exportable(false)
            ->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'MhsAktivitas_' . date('YmdHis');
    }
}
