<?php

namespace App\DataTables\Dosen;

use Carbon\Carbon;
use App\Models\MhsPrestasi;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class PrestasiDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($item) {
                return view('components.lib.action-show', [
                    'item' => $item,
                    'routeName' => 'dosen.prestasi.show',
                ]);
            })
            ->addColumn('url_penyelenggara', function ($item) {
                $url = $item->url_penyelenggara;
                if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                    $url = "http://" . $url;
                }
                return '<a href="' . $url . '" target="_blank">' . $url . '</a>';
            })
            ->editColumn('tropi', function ($item) {
                if (pathinfo($item->tropi, PATHINFO_EXTENSION) == 'pdf') {
                    return '<a href="' . asset('storage/' . $item->tropi) . '" class="btn btn-sm btn-primary" target="_blank">Lihat Berkas</a>';
                } else {
                    return '<img src="' . asset('storage/' . $item->tropi) . '" class="rounded img-thumb-sm image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item->tropi) . '">';
                }
            })
            ->editColumn('foto', function ($item) {
                return '<img src="' . asset('storage/' . $item->foto) . '" class="rounded img-thumb-sm image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item->foto) . '">';
            })
            ->editColumn('undangan', function ($item) {
                if (pathinfo($item->undangan, PATHINFO_EXTENSION) == 'pdf') {
                    return '<a href="' . asset('storage/' . $item->undangan) . '" class="btn btn-sm btn-primary" target="_blank">Lihat Berkas</a>';
                } else {
                    return '<img src="' . asset('storage/' . $item->undangan) . '" class="rounded img-thumb-sm image-clickable" data-bs-toggle="modal" data-bs-target="#myModal" data-image="' . asset('storage/' . $item->undangan) . '">';
                }
            })
            ->addColumn('tanggal_mulai', function ($item) {
                return Carbon::parse($item->tanggal_mulai)->locale('id')->isoFormat('D MMM YYYY');
            })
            ->addColumn('tanggal_selesai', function ($item) {
                return Carbon::parse($item->tanggal_selesai)->locale('id')->isoFormat('D MMM YYYY');
            })
            ->rawColumns(['url_penyelenggara','tropi', 'foto', 'undangan']);
    }

    public function query(MhsPrestasi $model)
    {
        $query = $model->newQuery()
            ->with(['mahasiswa.prodi', 'tingkat'])
            ->select([
                'mhs_prestasi.*',
                'mhs_prestasi.id as prestasi_id',
            ]);

            if ($this->user_id) {
                $query->whereHas('mahasiswa', function ($subquery) {
                    $subquery->where('user_id', $this->user_id);
                });
            }

            $angkatan = request('angkatan');
            $prodi = request('prodi');
            $tingkat = request('tingkat');

            if ($angkatan) {
                $query->whereHas('mahasiswa', function ($subquery) use ($angkatan) {
                    $subquery->whereIn('tahun_masuk', $angkatan);
                });
            }

            if ($prodi) {
                $query->whereHas('mahasiswa', function ($subquery) use ($prodi) {
                    $subquery->whereIn('id_prodi', $prodi);
                });
            }

            if ($tingkat) {
                $query->whereIn('id_kegiatan', $tingkat);
            }

            return $query;
    }

    public function html()
    {
        return $this->builder()
        ->setTableId('prestasi-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->scrollX(true)
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
            Column::make('DT_RowIndex')
                ->title('No.')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false),
            Column::computed('actions')
                ->title('Detail')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('mahasiswa.nim')->title('NIM'),
            Column::make('mahasiswa.nama')->title('Nama Mahasiswa'),
            Column::make('mahasiswa.prodi.nama')->title('Program Studi'),
            Column::make('mahasiswa.tahun_masuk')->title('Angkatan'),
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
        return 'Prestasi_' . date('YmdHis');
    }
}
