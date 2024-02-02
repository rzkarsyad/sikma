<?php

namespace App\DataTables\Master;

use App\Models\Mahasiswa;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class MahasiswaDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->setRowId('id')
            ->addColumn('actions', function ($item) {
                return view('mahasiswa.datatables_actions', compact('item'));
            })
            ->addColumn('formatted_jenis_kelamin', function ($item) {
                return $item->jns_kelamin === 'P' ? 'Pria' : 'Wanita';
            });
    }

    public function query(Mahasiswa $model)
    {
        return $model->newQuery()
        ->with(['prodi', 'jalur'])
        ->select([
            'mahasiswa.*',
            'mahasiswa.jns_kelamin',
            'mahasiswa.id as mahasiswa_id',
            'mahasiswa.id_prodi as prodi_id',
        ])
        ->addSelect(\DB::raw('CASE WHEN mahasiswa.jns_kelamin = "P" THEN "Pria" ELSE "Wanita" END as formatted_jenis_kelamin'));
}

    public function html()
    {
        $defaultOrderBy = Auth::user()->type == 'dosen' ? [2, 'asc'] : [1, 'asc'];

        return $this->builder()
            ->setTableId('mahasiswa-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->scrollX(true)
            ->responsive(true)
            ->orderBy($defaultOrderBy)
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
        $columns = [
            Column::make('DT_RowIndex')->title('No.')
            ->orderable(false)
            ->searchable(false)
            ->exportable(false)
            ->printable(false),
        ];
    
        if (Auth::user()->type == 'dosen') {
            $columns[] = Column::computed('actions')
            ->title('Detail')
            ->orderable(false)
            ->searchable(false)
            ->exportable(false)
            ->printable(false);
        }
    
        $columns[] = Column::make('nama')->title('Nama Lengkap');
        $columns[] = Column::make('prodi.nama')->title('Program Studi');
        $columns[] = Column::make('nim')->title('NIM');
        $columns[] = Column::make('institusi')->title('Institusi');
        $columns[] = Column::make('jalur.nama')->title('Jalur Masuk');
        $columns[] = Column::make('formatted_jenis_kelamin')->title('Jenis Kelamin');
        $columns[] = Column::make('tempat_lahir')->title('Tempat Lahir');
        $columns[] = Column::make('tgl_lahir')->title('Tanggal Lahir');
        $columns[] = Column::make('no_hp')->title('Nomor HP');
        $columns[] = Column::make('email')->title('Email');
        $columns[] = Column::make('alamat')->title('Alamat');
        $columns[] = Column::make('tahun_masuk')->title('Tahun Masuk');

        return $columns;
    }

    protected function filename(): string
    {
        return 'Mahasiswa_' . date('YmdHis');
    }
}
