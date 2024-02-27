<?php

namespace App\DataTables\Mahasiswa;

use App\Models\MhsKegiatan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MhsKegiatanDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($item) {
                return view('components.lib.action-mhs', [
                    'item' => $item,
                    'routeEdit' => 'm.mandiri-edit',
                    'routeDelete' => 'm.mandiri-delete',
                ]);
            })   
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
        $id = auth()->user()->id;

        return $model->newQuery()
            ->where('user_id', $id)
            ->with(['tingkat', 'jenis'])
            ->select([
                'mhs_kegiatan.*',
                'mhs_kegiatan.id as kegiatan_id',
            ]);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('mhskegiatan-table')
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
                // Apply custom styling after DataTable initialization
                $(".dataTables_wrapper").addClass("mb-3"); // Add margin-bottom to the entire DataTable container
                $(".dataTables_filter").addClass("mb-2"); // Add margin-bottom to the search bar
                $(".dataTables_length").addClass("mb-2"); // Add margin-bottom to the show entries dropdown
                $(".dataTables_paginate").addClass("mt-3"); // Add margin-top to the pagination container
                $(".dataTables_info").addClass("mt-3"); // Add margin-top to the showing text
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
        return 'MhsKegiatan_' . date('YmdHis');
    }
}
