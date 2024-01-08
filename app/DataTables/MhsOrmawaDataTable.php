<?php

namespace App\DataTables;

use App\Models\MhsOrmawa;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MhsOrmawaDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($item) {
                return view('mahasiswa.actions.mhs-ormawa', compact('item'));
            })
            ->editColumn('sk', function ($item) {
                if (pathinfo($item->sk, PATHINFO_EXTENSION) == 'pdf') {
                    // Display a button to download PDF
                    return '<a href="' . asset('storage/' . $item->sk) . '" class="btn btn-primary" download>Download PDF</a>';
                } else {
                    // Display an image with modal trigger
                    return '<img src="' . asset('storage/' . $item->sk) . '" class="rounded image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item->sk) . '" style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">';
                }
            })
            ->rawColumns(['sk']);
    }

    public function query(MhsOrmawa $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('mhsormawa-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->scrollX(true)
            ->responsive(true)
            ->orderBy(0) // Assuming 'No' column is the first one
            ->selectStyleSingle()
            ->buttons([
                'excel', 'csv', 'pdf', 'print', 'reset', 'reload'
            ]);
    }

    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('No.')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('ormawa.nama')->title('Jenis Organisasi'),
            Column::make('nama_ormawa')->title('Nama Organisasi'),
            Column::make('jabatan')->title('Jabatan'),
            Column::make('masa_jabatan')->title('Masa Jabatan'),
            Column::make('url_media_ormawa')->title('URL Sosial Media Ormawa'),
            Column::computed('sk')->title('SK Kepengurusan'),
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
        return 'MhsOrmawa_' . date('YmdHis');
    }
}
