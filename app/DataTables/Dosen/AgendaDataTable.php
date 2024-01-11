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
            ->addIndexColumn();
    }

    public function query(MhsAgenda $model)
    {
        $id = auth()->user()->id;

        return $model->newQuery()
            ->where('user_id', $id)
            ->with(['dosen'])
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
            Column::make('type')->title('Jenis Bimbingan'),
            Column::make('topic')->title('Topik'),
            Column::make('dosen.nama')->title('Nama Pembimbing'),
            Column::make('agenda_date')->title('Tanggal'),
            Column::make('agenda_time')->title('Waktu'),
            Column::make('content')->title('Isi'),
            Column::make('result')->title('Hasil'),
            Column::make('action')->title('Tindak Lanjut'),
            Column::make('status')->title('Status'),
        ];
    }

    protected function filename(): string
    {
        return 'Agenda_' . date('YmdHis');
    }
}
