<?php

namespace App\DataTables\Dosen;

use App\Models\MhsOrmawa;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrmawaDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($item) {
                return view('components.lib.action-show', [
                    'item' => $item,
                    'routeName' => 'dosen.ormawa.show',
                ]);
            })
            ->addColumn('url_media_ormawa', function ($item) {
                $url = $item->url_media_ormawa;
                if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                    $url = "http://" . $url;
                }
                return '<a href="' . $url . '" target="_blank">' . $url . '</a>';
            })
            ->editColumn('sk', function ($item) {
                if (pathinfo($item->sk, PATHINFO_EXTENSION) == 'pdf') {
                    return '<a href="' . asset('storage/' . $item->sk) . '" class="btn btn-sm btn-primary" target="_blank">Lihat Berkas</a>';
                } else {
                    return '<img src="' . asset('storage/' . $item->sk) . '" class="rounded image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item->sk) . '" style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">';
                }
            })
            ->rawColumns(['url_media_ormawa','sk']);
    }

    public function query(MhsOrmawa $model)
    {
        $query = $model->newQuery()
            ->with(['mahasiswa.prodi', 'mahasiswa.jalur', 'ormawa'])
            ->select([
                'mhs_ormawa.*',
                'mhs_ormawa.id as ormawa_id',
            ]);

        if ($this->user_id) {
            $query->whereHas('mahasiswa', function ($subquery) {
                $subquery->where('user_id', $this->user_id);
            });
        }

        $angkatan = request('angkatan');
        $prodi = request('prodi');
        $ormawa = request('ormawa');

        if ($angkatan) {
            $query->whereHas('mahasiswa', function ($subquery) use ($angkatan) {
                $subquery->whereIn('tahun_masuk', $angkatan);
            });
        }

        if ($prodi) {
            $query->whereHas('mahasiswa', function ($subquery) use ($prodi) {
                $subquery->whereIn('id_prodi', $prodi);
            });
        }

        if ($ormawa) {
            $query->whereIn('id_jenis_ormawa', $ormawa);
        }

        return $query;
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('ormawa-table')
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
            Column::computed('actions')
                ->title('Detail')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('mahasiswa.nim')->title('NIM'),
            Column::make('mahasiswa.nama')->title('Nama Mahasiswa'),
            Column::make('mahasiswa.prodi.nama')->title('Program Studi'),
            Column::make('mahasiswa.tahun_masuk')->title('Angkatan'),
            Column::make('ormawa.nama')->title('Jenis Organisasi'),
            Column::make('nama_ormawa')->title('Nama Organisasi'),
            Column::make('jabatan')->title('Jabatan'),
            Column::make('masa_jabatan')->title('Masa Jabatan'),
            Column::make('url_media_ormawa')->title('URL Sosial Media Ormawa'),
            Column::computed('sk')->title('SK Kepengurusan'),
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
        return 'Ormawa_' . date('YmdHis');
    }
}
