<?php

namespace App\DataTables\Dosen;

use App\Models\MhsAgenda;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AgendaDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($item) {
                return view('dosen.actions.action-agenda', compact('item'));
            })
            ->addColumn('type', function ($item) {
                $type = [
                    1 => 'Bimbingan Konseling',
                    2 => 'Bimbingan Pembina Ormawa',
                ];
    
                return $type[$item->type] ?? $item->type;
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
            ->rawColumns(['status']);
    }

    public function query(MhsAgenda $model)
    {
        $nidn = auth()->user()->nim_nidn;

        return $model->newQuery()
        ->whereHas('dosen', function ($query) use ($nidn) {
            $query->where('dosen_id', $nidn);
        })
        ->with(['dosen', 'mahasiswa'])
        ->select([
            'mhs_agenda.*',
            'mhs_agenda.id as agenda_id',
        ]);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('agenda-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->scrollX(true)
            ->autoWidth(true)
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
            Column::make('mahasiswa.nim')->title('NIM'),
            Column::make('mahasiswa.nama')->title('Nama Mahasiswa'),
            Column::make('type')->title('Jenis Bimbingan'),
            Column::make('topic')->title('Topik'),
            Column::make('dosen.nama')->title('Nama Pembimbing'),
            Column::make('agenda_date')->title('Tanggal'),
            Column::make('status')->title('Status'),
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
        return 'Agenda_' . date('YmdHis');
    }
}
