<?php

namespace App\DataTables\Master;

use App\Models\ListOrmawa;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ListOrmawaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->setRowId('id')
            ->addColumn('actions', function ($item) {
                return view('components.lib.actions.action-master', [
                    'item' => $item,
                    'editRouteName' => 'admin.ormawa.edit',
                    'deleteRouteName' => 'admin.ormawa.delete',
                ]);
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ListOrmawa $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('list-ormawa-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1, 'asc')
                    ->selectStyleSingle()
                    ->scrollX(true)
                    ->responsive(true)
                    ->initComplete('function(settings, json) {
                        $(".dataTables_wrapper").addClass("mb-3");
                        $(".dataTables_filter").addClass("mb-2");
                        $(".dataTables_length").addClass("mb-2");
                        $(".dataTables_paginate").addClass("mt-3");
                        $(".dataTables_info").addClass("mt-3");
                    }');
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No.')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->width('32px'),
            Column::make('nama')->title('Jenis Organisasi'),
            Column::computed('actions')
                ->title('Aksi')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->width('150px'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ListOrmawa_' . date('YmdHis');
    }
}
