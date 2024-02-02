<?php

namespace App\DataTables\Master;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DosenDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Dosen $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Dosen $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['prodi'])
            ->select(['dosen.*', 'jns_kelamin'])
            ->addSelect(\DB::raw('CASE WHEN jns_kelamin = "P" THEN "Pria" ELSE "Wanita" END as formatted_jenis_kelamin'));
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('dosen-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->scrollX(true)
                    ->responsive(true)
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No.')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('nidn')->title('NIDN'),
            Column::make('nama')->title('Nama Dosen'),
            Column::make('email')->title('Email'),
            Column::make('institusi')->title('Institusi'),
            
            Column::make('id_prodi')->title('Program Studi')
            ->data('prodi.nama')
            ->orderable(true),

            Column::computed('formatted_jenis_kelamin')
            ->title('Jenis Kelamin')
            ->data('formatted_jenis_kelamin')
            ->orderable(true),

            Column::make('jabatan')->title('Jabatan'),
            Column::make('no_hp')->title('Nomor HP'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Dosen_' . date('YmdHis');
    }
}
