<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\ListJenis;
use App\Models\Mahasiswa;
use App\Models\MhsAgenda;
use App\Models\MhsOrmawa;
use App\Models\ListOrmawa;
use App\Models\ListTingkat;
use App\Models\MhsKegiatan;
use App\Models\MhsPrestasi;
use App\Models\ListKategori;
use App\Models\ListKegiatan;
use App\Models\MhsAktivitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $angkatan = $this->getAngkatan();
        $prodi = Prodi::pluck('nama', 'id');

        $jenis_bimbingan = [
            1 => 'Bimbingan Konseling',
            2 => 'Bimbingan Pembina Ormawa',
        ];
        $status = [
            1 => 'Belum Diterima',
            2 => 'Diterima',
        ];

        return $dataTable->render('dosen.agenda', compact('angkatan', 'prodi', 'jenis_bimbingan', 'status'));
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
        $angkatan = $this->getAngkatan();
        $prodi = Prodi::pluck('nama', 'id');

        $kategori = ListKategori::pluck('nama', 'id');
        $kegiatan = ListKegiatan::pluck('nama', 'id');
        $tahun = $this->tahunDropdown();
        return $dataTable->render('dosen.aktivitas', compact('angkatan', 'prodi', 'kategori', 'kegiatan', 'tahun'));
    }

    public function mandiri(MandiriDataTable $dataTable)
    {
        $angkatan = $this->getAngkatan();
        $prodi = Prodi::pluck('nama', 'id');

        $tingkat = ListTingkat::pluck('nama', 'id');
        $jenis = ListJenis::pluck('nama', 'id');

        return $dataTable->render('dosen.mandiri', compact('angkatan', 'prodi', 'tingkat', 'jenis'));
    }

    public function prestasi(PrestasiDataTable $dataTable)
    {
        $angkatan = $this->getAngkatan();
        $prodi = Prodi::pluck('nama', 'id');

        $tingkat = ListTingkat::pluck('nama', 'id');

        return $dataTable->render('dosen.prestasi', compact('angkatan', 'prodi', 'tingkat'));
    }

    public function ormawa(OrmawaDataTable $dataTable)
    {
        $angkatan = $this->getAngkatan();
        $prodi = Prodi::pluck('nama', 'id');

        $ormawa = ListOrmawa::pluck('nama', 'id');
        
        return $dataTable->render('dosen.ormawa', compact('angkatan', 'prodi', 'ormawa'));
    }

    public function listMahasiswa(MahasiswaDataTable $dataTable)
    {
        return $dataTable->render('dosen.mahasiswa');
    }

    public function showMhs($id, AktivitasDataTable $dataTable)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        $dataTable->setUserId($mahasiswa->user_id);

        return $dataTable->render('dosen.detail-mahasiswa', compact('mahasiswa'));
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

    public function getAngkatan()
    {
        $currentYear = date('Y');
        $startYear = $currentYear - 15;
        $tahunMasukOptions = [];

        for ($year = $currentYear; $year >= $startYear; $year--) {
            $tahunMasukOptions[$year] = $year;
        }

        return $tahunMasukOptions;
    }

    public function tahunDropdown()
    {
        $currentYear = date('Y');
        $startYear = $currentYear - 15;
        $tahun = [];

        for ($year = $currentYear; $year >= $startYear; $year--) {
            $tahun[$year] = $year;
        }

        return $tahun;
    }
}
