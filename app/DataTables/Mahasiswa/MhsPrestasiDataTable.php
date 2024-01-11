<?php

namespace App\DataTables\Mahasiswa;

use App\Models\MhsPrestasi;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MhsPrestasiDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($item) {
                return view('mahasiswa.actions.mhs-prestasi', compact('item'));
            })
            ->editColumn('tropi', function ($item) {
                if (pathinfo($item->tropi, PATHINFO_EXTENSION) == 'pdf') {
                    return '<a href="' . asset('storage/' . $item->tropi) . '" class="btn btn-sm btn-primary" target="_blank">Lihat Berkas</a>';
                } else {
                    return '<img src="' . asset('storage/' . $item->tropi) . '" class="rounded image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item->tropi) . '" style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">';
                }
            })
            ->editColumn('foto', function ($item) {
                return '<img src="' . asset('storage/' . $item->foto) . '" class="rounded image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item->foto) . '" style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">';
            })
            ->editColumn('undangan', function ($item) {
                if (pathinfo($item->undangan, PATHINFO_EXTENSION) == 'pdf') {
                    return '<a href="' . asset('storage/' . $item->undangan) . '" class="btn btn-sm btn-primary" target="_blank">Lihat Berkas</a>';
                } else {
                    return '<img src="' . asset('storage/' . $item->undangan) . '" class="rounded image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item->undangan) . '" style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">';
                }
            })
            ->rawColumns(['tropi', 'foto', 'undangan']);
    }

    public function query(MhsPrestasi $model)
    {
        $id = auth()->user()->id;

        return $model->newQuery()
            ->where('user_id', $id)
            ->with(['tingkat'])
            ->select([
                'mhs_prestasi.*',
                'mhs_prestasi.id as prestasi_id',
            ]);
    }

    public function html()
    {
        return $this->builder()
        ->setTableId('mhsprestasi-table')
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
            ->exportable(false),
            Column::make('tingkat.nama')->title('Tingkat'),
            Column::make('nama')->title('Nama Kegiatan'),
            Column::make('penyelenggara')->title('Penyelenggara'),
            Column::make('jumlah')->title('Jumlah Peserta'),
            Column::make('capaian')->title('Capaian'),
            Column::make('tanggal_mulai')->title('Tgl Mulai'),
            Column::make('tanggal_selesai')->title('Tgl Selesai'),
            Column::make('url_penyelenggara')->title('URL Penyelenggara'),
            Column::computed('tropi')->title('Tropi'),
            Column::computed('foto')->title('Foto'),
            Column::computed('undangan')->title('Surat Undangan'),
            Column::computed('actions')
            ->title('Aksi')
            ->orderable(false)
            ->searchable(false)
            ->exportable(false)
            ->printable(false)
        ];
    }

    protected function filename(): string
    {
        return 'MhsPrestasi_' . date('YmdHis');
    }
}
