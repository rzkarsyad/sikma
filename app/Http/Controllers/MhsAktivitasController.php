<?php

namespace App\Http\Controllers;

use App\Models\ListKategori;
use App\Models\ListKegiatan;
use App\Models\MhsAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\DataTables\Mahasiswa\MhsAktivitasDataTable;

class MhsAktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MhsAktivitasDataTable $dataTable)
    {
        return $dataTable->render('mahasiswa.aktivitas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = ListKategori::pluck('nama', 'id');
        $kegiatan = ListKegiatan::pluck('nama', 'id');
        $tahun = $this->tahunDropdown();
        return view('mahasiswa.aktivitas.create', compact('kategori', 'kegiatan', 'tahun'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateAktivitas($request);

        $foto = $request->file('foto')->store('foto', 'public');
        $sertifikat = $request->file('sertifikat')->store('sertifikat', 'public');

        $user = Auth::user();
        $nim = $user->mahasiswa->nim;
        $user_id = $user->id;

        MhsAktivitas::create([
            'user_id' => $user_id,
            'id_aktivitas' => $request->id_aktivitas,
            'id_kategori' => $request->id_kategori,
            'tahun' => $request->tahun,
            'sertifikat' => $sertifikat,
            'foto' => $foto,
            'url_penyelenggara' => $request->url_penyelenggara,
        ]);

        return redirect()->route('m.aktivitas')->with('success', 'Data aktivitas berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mhsAktivitas = MhsAktivitas::findOrFail($id);
        $kategori = ListKategori::pluck('nama', 'id');
        $kegiatan = ListKegiatan::pluck('nama', 'id');
        $tahun = $this->tahunDropdown();
        return view('mahasiswa.aktivitas.edit', compact('kategori', 'kegiatan', 'tahun', 'mhsAktivitas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateAktivitas($request, false);

        $mhsAktivitas = MhsAktivitas::findOrFail($id);

        $mhsAktivitas->id_aktivitas = $request->id_aktivitas;
        $mhsAktivitas->id_kategori = $request->id_kategori;
        $mhsAktivitas->tahun = $request->tahun;
        $mhsAktivitas->url_penyelenggara = $request->url_penyelenggara;

        if ($request->hasFile('foto')) {
            $pathF = $mhsAktivitas->foto;
            if ($pathF != null || $pathF != '') {
                Storage::disk('public')->delete($pathF);
            }
            $foto = $request->file('foto')->store('foto', 'public');
            $mhsAktivitas->foto = $foto;
        }

        if ($request->hasFile('sertifikat')) {
            $pathS = $mhsAktivitas->sertifikat;
            if ($pathS != null || $pathS != '') {
                Storage::disk('public')->delete($pathS);
            }
            $sertifikat = $request->file('sertifikat')->store('sertifikat', 'public');
            $mhsAktivitas->sertifikat = $sertifikat;
        }

        $mhsAktivitas->save();

        return redirect()->route('m.aktivitas')->with('success', 'Data aktivitas berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mhsAktivitas = MhsAktivitas::findOrFail($id);
        $foto = $mhsAktivitas->foto;
        $sertifikat = $mhsAktivitas->sertifikat;

        if ($foto != null || $foto != '') {
            Storage::disk('public')->delete($foto);
        }

        if ($sertifikat != null || $sertifikat != '') {
            Storage::disk('public')->delete($sertifikat);
        }

        $mhsAktivitas->delete();

        return redirect()->route('m.aktivitas')->with('success', 'Data aktivitas berhasil dihapus.');
    }

    /**
     * Validate the Aktivitas form data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $validateFotoSertifikat
     * @return void
     */
    public function validateAktivitas(Request $request, $validateFotoSertifikat = true)
    {
        $rules = [
            'id_aktivitas' => 'required',
            'id_kategori' => 'required',
            'tahun' => 'required',
            'url_penyelenggara' => 'required',
        ];

        $messages = [
            'id_aktivitas.required' => 'Nama aktivitas tidak boleh kosong',
            'id_kategori.required' => 'Kategori aktivitas tidak boleh kosong',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'url_penyelenggara.required' => 'URL tidak boleh kosong',
        ];

        if ($validateFotoSertifikat) {
            $rules['sertifikat'] = 'required|file|mimes:pdf,jpeg,png,jpg,webp|max:2048';
            $rules['foto'] = 'required|image|mimes:jpeg,png,jpg,webp|max:2048';

            $messages['sertifikat.required'] = 'Sertifikat tidak boleh kosong';
            $messages['sertifikat.mimes'] = 'Sertifikat harus memiliki format pdf, jpeg, png, jpg, webp';
            $messages['foto.required'] = 'Foto tidak boleh kosong';
            $messages['foto.mimes'] = 'Foto harus memiliki format jpeg, png, jpg';
        }

        $request->validate($rules, $messages);
    }

    /**
     * Get the dropdown options for the year.
     *
     * @return array
     */
    public function tahunDropdown()
    {
        $tahunAwal = 2015;
        $tahunAkhir = date('Y');
        $tahun = range($tahunAkhir, $tahunAwal);

        return $tahun;
    }
}
