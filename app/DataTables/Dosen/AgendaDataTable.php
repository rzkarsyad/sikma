<?php

namespace App\DataTables\Dosen;

use Carbon\Carbon;
use App\Models\MhsAgenda;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AgendaDataTable extends DataTable
{
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($item) {
                return view('components.lib.action-agenda', compact('item'));
            })
            ->addColumn('status', function ($item) {
                $status = [
                    1 => 'Belum diterima',
                    2 => 'Diterima',
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
                    default:
                        $badgeClass = 'text-bg-secondary';
                        break;
                }

                return '<span class="badge rounded-pill ' . $badgeClass . '">' . $statusText . '</span>';
            })
            ->addColumn('agenda_date', function ($item) {
                return Carbon::parse($item->agenda_date)->locale('id')->isoFormat('D MMM YYYY');
            })
            ->rawColumns(['status']);
    }

    public function query(MhsAgenda $model)
    {
        $nidn = auth()->user()->nim_nidn;

        $query = $model->newQuery()
            ->whereHas('dosen', function ($query) use ($nidn) {
                $query->where('dosen_id', $nidn);
            })
            ->with(['type' ,'dosen', 'mahasiswa', 'mahasiswa.prodi'])
            ->select([
                'mhs_agenda.*',
                'mhs_agenda.id as agenda_id',
                'mhs_agenda.id_agenda as id_agenda',
            ]);

        $angkatan = request('angkatan');
        $prodi = request('prodi');
        $bimbingan = request('bimbingan');
        $status = request('status');

        if (!empty($angkatan)) {
            $query->whereHas('mahasiswa', function ($query) use ($angkatan) {
                $query->whereIn('tahun_masuk', $angkatan);
            });
        }

        if (!empty($prodi)) {
            $query->whereHas('mahasiswa', function ($query) use ($prodi) {
                $query->whereIn('id_prodi', $prodi);
            });
        }

        if (!empty($bimbingan)) {
            $query->whereIn('id_agenda', $bimbingan);
        }

        if (!empty($status)) {
            $query->whereIn('status', $status);
        }

        return $query;
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
            Column::make('mahasiswa.nim')->title('NIM'),
            Column::make('mahasiswa.nama')->title('Nama Mahasiswa'),
            Column::make('mahasiswa.prodi.nama')->title('Program Studi'),
            Column::make('mahasiswa.tahun_masuk')->title('Angkatan'),
            Column::make('type.nama')->title('Jenis Bimbingan'),
            Column::make('topic')->title('Topik'),
            Column::make('agenda_date')->title('Tanggal'),
            Column::make('status')->title('Status'),
            Column::computed('actions')
                ->title('Aksi')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false),
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
        return 'Agenda_' . date('YmdHis');
    }
}
