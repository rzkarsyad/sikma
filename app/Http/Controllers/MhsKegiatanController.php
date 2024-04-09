<?php

namespace App\Http\Controllers;

use App\Models\ListJenis;
use App\Models\ListTingkat;
use App\Models\MhsKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\DataTables\Mahasiswa\MhsKegiatanDataTable;

class MhsKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MhsKegiatanDataTable $dataTable)
    {
        return $dataTable->render('mahasiswa.mandiri.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tingkat = ListTingkat::pluck('nama', 'id');
        $jenis = ListJenis::pluck('nama', 'id');

        $backRoute = route('m.mandiri');

        return view('mahasiswa.mandiri.create', compact('tingkat', 'jenis', 'backRoute'));
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
        $undangan = $request->file('undangan')->store('undangan', 'public');

        $user = Auth::user();
        $nim = $user->mahasiswa->nim;
        $user_id = $user->id;

        MhsKegiatan::create([
            'user_id' => $user_id,
            'id_kegiatan' => $request->id_kegiatan,
            'id_jenis' => $request->id_jenis,
            'nama' => $request->nama,
            'penyelenggara'=> $request->penyelenggara,
            'jumlah'=> $request->jumlah,
            'tanggal_mulai'=>$request->tanggal_mulai,
            'tanggal_selesai'=>$request->tanggal_selesai,
            'sertifikat' => $sertifikat,
            'foto' => $foto,
            'undangan'=> $undangan,
            'url_penyelenggara' => $request->url_penyelenggara,
        ]);

        return redirect()->route('m.mandiri')->with('success', 'Data kegiatan mandiri berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mhsKegiatan = MhsKegiatan::findOrFail($id);
        $tingkat = ListTingkat::pluck('nama', 'id');
        $jenis = ListJenis::pluck('nama', 'id');
        return view('mahasiswa.mandiri.edit', compact('tingkat', 'jenis', 'mhsKegiatan'));
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

        $mhsKegiatan = MhsKegiatan::findOrFail($id);

        $mhsKegiatan->id_kegiatan = $request->id_kegiatan;
        $mhsKegiatan->id_jenis = $request->id_jenis;
        $mhsKegiatan->nama= $request->nama;
        $mhsKegiatan->penyelenggara= $request->penyelenggara;
        $mhsKegiatan->jumlah= $request->jumlah;
        $mhsKegiatan->tanggal_mulai= $request->tanggal_mulai;
        $mhsKegiatan->tanggal_selesai= $request->tanggal_selesai;
        $mhsKegiatan->url_penyelenggara = $request->url_penyelenggara;

        if ($request->hasFile('foto')) {
            $pathF = $mhsKegiatan->foto;
            if ($pathF != null || $pathF != '') {
                Storage::disk('public')->delete($pathF);
            }
            $foto = $request->file('foto')->store('foto', 'public');
            $mhsKegiatan->foto = $foto;
        }

        if ($request->hasFile('sertifikat')) {
            $pathS = $mhsKegiatan->sertifikat;
            if ($pathS != null || $pathS != '') {
                Storage::disk('public')->delete($pathS);
            }
            $sertifikat = $request->file('sertifikat')->store('sertifikat', 'public');
            $mhsKegiatan->sertifikat = $sertifikat;
        }
        if ($request->hasFile('undangan')) {
            $pathS = $mhsKegiatan->undangan;
            if ($pathS != null || $pathS != '') {
                Storage::disk('public')->delete($pathS);
            }
            $undangan = $request->file('undangan')->store('undangan', 'public');
            $mhsKegiatan->undangan = $undangan;
        }

        $mhsKegiatan->save();

        return redirect()->route('m.mandiri')->with('success', 'Data kegiatan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mhsKegiatan = MhsKegiatan::findOrFail($id);
        $foto = $mhsKegiatan->foto;
        $sertifikat = $mhsKegiatan->sertifikat;
        $undangan = $mhsKegiatan->undangan;

        if ($foto != null || $foto != '') {
            Storage::disk('public')->delete($foto);
        }

        if ($sertifikat != null || $sertifikat != '') {
            Storage::disk('public')->delete($sertifikat);
        }

        if ($undangan != null || $undangan != '') {
            Storage::disk('public')->delete($undangan);
        }

        $mhsKegiatan->delete();

        return redirect()->route('m.mandiri')->with('success', 'Data kegiatan berhasil dihapus.');
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
            'id_kegiatan' => 'required',
            'id_jenis' => 'required',
            'nama' => 'required',
            'penyelenggara' => 'required',
            'jumlah' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'url_penyelenggara' => 'required',
        ];

        $messages = [
            'id_jenis' => 'Tingkat tidak boleh kosong',
            'nama' => 'Nama kegiatan tidak boleh kosong',
            'penyelenggara' => 'Penyelenggara tidak boleh kosong',
            'jumlah' => 'Jumlah Peserta tidak boleh kosong',
            'tanggal_mulai' => 'Tanggal mulai tidak boleh kosong',
            'tanggal_selesai' => 'Tanggal selesai tidak boleh kosong',
            'url_penyelenggara' => 'URL Penyelenggara tidak boleh kosong',
        ];

        if ($validateFotoSertifikat) {
            $rules['sertifikat'] = 'required|file|mimes:pdf,jpeg,png,jpg,webp|max:2048';
            $rules['foto'] = 'required|image|mimes:jpeg,png,jpg,webp|max:2048';
            $rules['undangan'] = 'required|file|mimes:pdf,jpeg,png,jpg,webp|max:2048';

            $messages['sertifikat.required'] = 'Sertifikat tidak boleh kosong';
            $messages['sertifikat.mimes'] = 'Sertifikat harus memiliki format pdf, jpeg, png, jpg, webp';

            $messages['foto.required'] = 'Foto tidak boleh kosong';
            $messages['foto.mimes'] = 'Foto harus memiliki format jpeg, png, jpg';

            $messages['undangan.required'] = 'Undangan tidak boleh kosong';
            $messages['undangan.mimes'] = 'Undangan harus memiliki format pdf, jpeg, png, jpg';
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
