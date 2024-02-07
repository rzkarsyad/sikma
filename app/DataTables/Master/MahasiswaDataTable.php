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
        $query = $model->newQuery()
        ->with(['prodi', 'jalur'])
        ->select([
            'mahasiswa.*',
            'mahasiswa.jns_kelamin',
            'mahasiswa.id as mahasiswa_id',
            'mahasiswa.id_prodi as prodi_id',
        ])
        ->addSelect(\DB::raw('CASE WHEN mahasiswa.jns_kelamin = "P" THEN "Pria" ELSE "Wanita" END as formatted_jenis_kelamin'));
        
        $angkatan = request('angkatan');
        $prodi = request('prodi');
        $jalur = request('jalur');

        if ($angkatan) {
            $query->where('tahun_masuk', $angkatan);
        }

        if ($prodi) {
            $query->where('id_prodi', $prodi);
        }

        if ($jalur) {
            $query->where('id_jalur', $jalur);
        }

        return $query;
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
                ->exportable(false),
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
        $columns[] = Column::make('jalur.nama')->title('Jalur Masuk');
        $columns[] = Column::make('tahun_masuk')->title('Tahun Masuk');
        $columns[] = Column::make('formatted_jenis_kelamin')->title('Jenis Kelamin');
        $columns[] = Column::make('tempat_lahir')->title('Tempat Lahir');
        $columns[] = Column::make('tgl_lahir')->title('Tanggal Lahir');
        $columns[] = Column::make('no_hp')->title('Nomor HP');
        $columns[] = Column::make('email')->title('Email');
        $columns[] = Column::make('alamat')->title('Alamat');
    
        return $columns;
    }    

    protected function filename(): string
    {
        return 'Mahasiswa_' . date('YmdHis');
    }
}
