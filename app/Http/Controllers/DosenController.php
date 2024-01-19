<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MhsAgenda;
use App\Models\MhsOrmawa;
use App\Models\MhsKegiatan;
use App\Models\MhsPrestasi;
use App\Models\MhsAktivitas;
use Illuminate\Http\Request;
use App\DataTables\Dosen\AgendaDataTable;
use App\DataTables\Dosen\OrmawaDataTable;
use App\DataTables\Dosen\MandiriDataTable;
use App\DataTables\Dosen\PrestasiDataTable;
use App\DataTables\Dosen\AktivitasDataTable;
use App\DataTables\Master\MahasiswaDataTable;

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

    public function agenda(AgendaDataTable $dataTable)
    {
        return $dataTable->render('dosen.agenda');
    }

    public function showAgenda($id)
    {
        $mhsAgenda = MhsAgenda::findOrFail($id);

        $type = [
            1 => 'Bimbingan Konseling',
            2 => 'Bimbingan Pembina Ormawa',
        ];

        $type = $type[$mhsAgenda->type] ?? $mhsAgenda->type;
        
        $mahasiswa = $mhsAgenda->mahasiswa;
        $dosen = $mhsAgenda->dosen;

        return view('dosen.show-agenda')->with([
            'mhsAgenda' => $mhsAgenda,
            'type' => $type,
            'mahasiswa' => $mahasiswa,
            'dosen' => $dosen,
        ]);
    }

    public function updateAgenda(Request $request, $id)
    {
        $this->validateAgenda($request);
        
        $mhsAgenda = MhsAgenda::findOrFail($id);

        $mhsAgenda->result = $request->result;
        $mhsAgenda->action = $request->action;
        $mhsAgenda->status = 2;

        $mhsAgenda->save();

        return redirect()->route('dosen.agenda')->with('success', 'Bimbingan berhasil ditinjau.');
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

    public function validateAgenda(Request $request)
    {
        $rules = [
            'result' => 'required',
            'action' => 'required',
        ];

        $messages = [
            'result.required' => 'Hasil tidak boleh kosong',
            'action.required' => 'Tindak lanjut tidak boleh kosong',
        ];

        $request->validate($rules, $messages);
    }

}
