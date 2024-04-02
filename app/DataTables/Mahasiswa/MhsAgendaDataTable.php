<?php

namespace App\DataTables\Mahasiswa;

use App\Models\MhsAgenda;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MhsAgendaDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($item) {
                return view('components.lib.action-mhsAgenda', compact('item'));
            })
            ->addColumn('status', function ($item) {
                $status = [
                    1 => 'Belum diterima',
                    2 => 'Diterima',
                    3 => 'Selesai',
                ];

                $statusText = $status[$item->status] ?? $item->status;
                $badgeClass = '';

                switch ($item->status) {
                    case 1:
                        $badgeClass = 'text-bg-danger';
                        break;
                    case 2:
                        $badgeClass = 'text-bg-success';
                        break;
                    case 3:
                        $badgeClass = 'text-bg-primary';
                        break;
                    default:
                        $badgeClass = 'text-bg-secondary';
                        break;
                }

                return '<span class="badge rounded-pill ' . $badgeClass . '">' . $statusText . '</span>';
            })
            ->rawColumns(['status', 'actions']);
        }

    public function query(MhsAgenda $model)
    {
        $id = auth()->user()->id;

        return $model->newQuery()
            ->where('user_id', $id)
            ->with(['dosen', 'type'])
            ->select([
                'mhs_agenda.*',
                'mhs_agenda.id as agenda_id',
            ]);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('mhsagenda-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->scrollX(true)
            ->scrollCollapse(true)
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
            Column::make('type.nama')->title('Jenis Bimbingan'),
            Column::make('topic')->title('Topik'),
            Column::make('dosen.nama')->title('Nama Pembimbing'),
            Column::make('agenda_date')->title('Tanggal'),
            Column::make('agenda_time')->title('Waktu'),
            Column::computed('status')->title('Status'),
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
        return 'MhsAgenda_' . date('YmdHis');
    }
}
