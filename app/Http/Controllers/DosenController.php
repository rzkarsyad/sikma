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

        $status = [
            1 => 'Belum diterima',
            2 => 'Diterima',
            3 => 'Selesai',
        ];
    
        $statusText = $status[$mhsAgenda->status] ?? $mhsAgenda->status;
        $badgeClass = '';
    
        switch ($mhsAgenda->status) {
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

        $type = [
            1 => 'Bimbingan Konseling',
            2 => 'Bimbingan Pembina Ormawa',
        ];

        $type = $type[$mhsAgenda->type] ?? $mhsAgenda->type;

        return view('dosen.show-agenda')->with([
            'statusText' => $statusText,
            'badgeClass' => $badgeClass,
            'mhsAgenda' => $mhsAgenda,
            'type' => $type,
        ]);
    }

    public function storeAgenda(Request $request)
    {
        $this->validateAgenda($request);
        
        $user = Auth::user();
        $nim = $user->mahasiswa->nim;
        $user_id = $user->id;

        MhsAgenda::create([
            'user_id' => $user_id,
            'type' => $request->type,
            'agenda_date' => $request->agenda_date,
            'agenda_time' => $request->agenda_time,
            'dosen_id' => $request->dosen_id,
            'topic' => $request->topic,
            'content' => $request->content,
        ]);

        return redirect()->route('m.agenda')->with('success', 'Bimbingan berhasil ditinjau.');
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
