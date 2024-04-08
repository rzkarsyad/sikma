<?php

namespace App\DataTables\Master;

use App\Models\User;
use App\Models\Admin;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AdminDataTable extends DataTable
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
        ->addColumn('nim_nidn', function ($item) {
            if (Auth::check() && Auth::id() == $item->id) {
                return $item->nim_nidn . '<span class="badge text-bg-dark ms-3">Anda</span>';
            } else {
                return $item->nim_nidn;
            }
        })
        ->addColumn('actions', function ($item) {
            return view('components.lib.actions.action-admin', ['item' => $item]);
        })
        ->rawColumns(['nim_nidn']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->where('type', 2);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('admin-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
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
        $loggedInUsername = Auth::user()->nim_nidn;

        return [
            Column::make('DT_RowIndex')->title('No.')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->width('10px'),
            Column::make('nim_nidn')->title('Username'),
            Column::make('email')->title('Email'),
            Column::computed('actions')
                ->title('Aksi')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->width('32px'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Admin_' . date('YmdHis');
    }
}
