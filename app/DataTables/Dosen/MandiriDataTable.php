<?php

namespace App\DataTables\Dosen;

use App\Models\MhsKegiatan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MandiriDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('sertifikat', function ($item) {
                if (pathinfo($item->sertifikat, PATHINFO_EXTENSION) == 'pdf') {
                    return '<a href="' . asset('storage/' . $item->sertifikat) . '" class="btn btn-sm btn-primary" target="_blank">Lihat Berkas</a>';
                } else {
                    return '<img src="' . asset('storage/' . $item->sertifikat) . '" class="rounded image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item->sertifikat) . '" style="width: 64px; height: 40px; cursor: pointer; object-fit: cover;">';
                }
            })               
            ->editColumn('foto', function ($item) {
                return '<img src="' . asset('storage/' . $item['foto']) . '" class="rounded image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item['foto']) . '" style="width: 64px; height: 40px; cursor: pointer; object-fit: cover;">';
            })
            ->rawColumns(['sertifikat', 'foto']);
    }

    public function query(MhsKegiatan $model)
    {
        return $model->newQuery()
            ->with(['mahasiswa.prodi', 'mahasiswa.jalur', 'kegiatan', 'kategori'])
            ->select([
                'mhs_kegiatan.*',
                'mhs_kegiatan.id as aktivitas_id',
            ]);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('mandiri-table')
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
            Column::make('mahasiswa.nim')->title('NIM'),
            Column::make('mahasiswa.nama')->title('Nama Mahasiswa'),
            Column::make('mahasiswa.prodi.nama')->title('Prodi'),
            Column::make('mahasiswa.jalur.nama')->title('Jalur Masuk'),
            Column::make('kegiatan.nama')->title('Nama Kegiatan'),
            Column::make('kategori.nama')->title('Kategori Kegiatan'),
            Column::make('jenis.nama')->title('Jenis Kepesertaan'),
            Column::make('mhskegiatan.nama')->title('Nama Kegiatan'),
            Column::make('mhskegiatan.penyelenggara')->title('Penyelenggara'),
            Column::make('mhskegiatan.jumlah')->title('Jumlah Peserta'),
            Column::make('mhskegiatan.tanggal_mulai')->title('Tanggal Mulai'),
            Column::make('mhskegiatan.tanggal_selesai')->title('Tanggal Selesai'),
            Column::make('mhskegiatan.url_penyelenggara')->title('URL Penyelenggara'),
            Column::computed('sertifikat')
                ->title('Sertifikat')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false),
            Column::computed('foto')
                ->title('Foto')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('mhskegiatan.url_penyelenggara')->title('URL Penyelenggara'),
        ];
    }

    protected function filename(): string
    {
        return 'Mandiri_' . date('YmdHis');
    }
}
