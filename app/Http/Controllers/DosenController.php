<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MhsOrmawa;
use App\Models\MhsKegiatan;
use App\Models\MhsPrestasi;
use App\Models\MhsAktivitas;
use Illuminate\Http\Request;
use App\DataTables\Dosen\OrmawaDataTable;
use App\DataTables\Dosen\MandiriDataTable;
use App\DataTables\Dosen\PrestasiDataTable;
use App\DataTables\Master\MahasiswaDataTable;
use App\DataTables\Dosen\AktivitasDataTable;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        //
    }

    public function aktivitas(AktivitasDataTable $dataTable)
    {
        return $dataTable->render('dosen.aktivitas');
    }

    public function mandiri(MandiriDataTable $dataTable)
    {
        return $dataTable->render('dosen.mandiri');
    }

    public function prestasi(PrestasiDataTable $dataTable)
    {
        return $dataTable->render('dosen.prestasi');
    }

    public function ormawa(OrmawaDataTable $dataTable)
    {
        return $dataTable->render('dosen.ormawa');
    }

    public function listMahasiswa(MahasiswaDataTable $dataTable)
    {
        return $dataTable->render('dosen.mahasiswa');
    }

    public function showMhs(string $id){

        $mahasiswa = Mahasiswa::with(['aktivitas', 'kegiatan', 'prestasi', 'ormawa'])->findOrFail($id);

        return view('dosen.detail-mahasiswa', compact('mahasiswa'));

    }

}
