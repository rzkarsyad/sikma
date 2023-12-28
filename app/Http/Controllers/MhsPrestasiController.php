<?php

namespace App\Http\Controllers;

use App\Models\MhsPrestasi;
use App\Models\ListTingkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class MhsPrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $mhsPrestasi = MhsPrestasi::where('user_id', $id)->get();
        return view('mahasiswa.prestasi', compact('mhsPrestasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tingkat = ListTingkat::pluck('nama', 'id');
        return view('mahasiswa.prestasi-create', compact('tingkat'));
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
        $tropi = $request->file('tropi')->store('tropi', 'public');
        $undangan = $request->file('undangan')->store('tropi', 'public');

        $user = Auth::user();
        $nim = $user->mahasiswa->nim;
        $user_id = $user->id;

        MhsPrestasi::create([
            'user_id' => $user_id,
            'id_kegiatan' => $request->id_kegiatan,
            'nama' => $request->nama,
            'penyelenggara' => $request->penyelenggara,
            'jumlah' => $request->jumlah,
            'capaian' => $request->capaian,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'tropi' => $tropi,
            'url_penyelenggara' => $request->url_penyelenggara,
            'foto' => $foto,
            'undangan' => $undangan,
        ]);

        return redirect()->route('m.prestasi')->with('success', 'Data aktivitas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MhsPrestasi  $mhsPrestasi
     * @return \Illuminate\Http\Response
     */
    public function show(MhsPrestasi $mhsPrestasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MhsPrestasi  $mhsPrestasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mhsPrestasi = MhsPrestasi::findOrFail($id);
        $tingkat = ListTingkat::pluck('nama', 'id');
        return view('mahasiswa.prestasi-edit', compact('mhsPrestasi', 'tingkat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MhsPrestasi  $mhsPrestasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateAktivitas($request, false);

        $mhsPrestasi = MhsPrestasi::findOrFail($id);

        $mhsPrestasi->id_kegiatan = $request->id_kegiatan;
        $mhsPrestasi->nama= $request->nama;
        $mhsPrestasi->penyelenggara= $request->penyelenggara;
        $mhsPrestasi->jumlah= $request->jumlah;
        $mhsPrestasi->capaian= $request->capaian;
        $mhsPrestasi->tanggal_mulai= $request->tanggal_mulai;
        $mhsPrestasi->tanggal_selesai= $request->tanggal_selesai;
        $mhsPrestasi->url_penyelenggara = $request->url_penyelenggara;

        if ($request->hasFile('foto')) {
            $pathF = $mhsPrestasi->foto;
            if ($pathF != null || $pathF != '') {
                Storage::disk('public')->delete($pathF);
            }
            $foto = $request->file('foto')->store('foto', 'public');
            $mhsPrestasi->foto = $foto;
        }

        if ($request->hasFile('tropi')) {
            $pathS = $mhsPrestasi->tropi;
            if ($pathS != null || $pathS != '') {
                Storage::disk('public')->delete($pathS);
            }
            $tropi = $request->file('tropi')->store('tropi', 'public');
            $mhsPrestasi->tropi = $tropi;
        }
        if ($request->hasFile('undangan')) {
            $pathS = $mhsPrestasi->undangan;
            if ($pathS != null || $pathS != '') {
                Storage::disk('public')->delete($pathS);
            }
            $undangan = $request->file('undangan')->store('undangan', 'public');
            $mhsPrestasi->undangan = $undangan;
        }

        $mhsPrestasi->save();

        return redirect()->route('m.prestasi')->with('success', 'Data prestasi berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MhsPrestasi  $mhsPrestasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mhsPrestasi = MhsPrestasi::findOrFail($id);
        $foto = $mhsPrestasi->foto;
        $tropi = $mhsPrestasi->tropi;
        $undangan = $mhsPrestasi->undangan;

        if ($foto != null || $foto != '') {
            Storage::disk('public')->delete($foto);
        }

        if ($tropi != null || $tropi != '') {
            Storage::disk('public')->delete($tropi);
        }

        if ($undangan != null || $undangan != '') {
            Storage::disk('public')->delete($undangan);
        }

        $mhsPrestasi->delete();

        return redirect()->route('m.prestasi')->with('success', 'Data kegiatan berhasil dihapus.');
    }

    public function validateAktivitas(Request $request, $validateFotoSertifikat = true)
    {
        $rules = [
            'id_kegiatan' => 'required',
            'nama' => 'required',
            'penyelenggara' => 'required',
            'jumlah' => 'required',
            'capaian' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'url_penyelenggara' => 'required',
        ];

        $messages = [
            'id_kegiatan.required' => 'Tingkat tidak boleh kosong',
            'nama.required' => 'Nama prestasi tidak boleh kosong',
            'penyelenggara.required' => 'Penyelenggara tidak boleh kosong',
            'jumlah.required' => 'Jumlah peserta tidak boleh kosong',
            'capaian.required' => 'Capaian tidak boleh kosong',
            'tanggal_mulai.required' => 'Tanggal mulai tidak boleh kosong',
            'tanggal_selesai.required' => 'Tanggal selesai tidak boleh kosong',
            'url_penyelenggara.required' => 'URL tidak boleh kosong',
        ];

        if ($validateFotoSertifikat) {
            $rules['tropi'] = 'required|file|mimes:pdf,jpeg,png,jpg,webp|max:2048';
            $rules['foto'] = 'required|image|mimes:jpeg,png,jpg,webp|max:2048';
            $rules['undangan'] = 'required|file|mimes:pdf,jpeg,png,jpg,webp|max:2048';

            $messages['tropi.required'] = 'Sertifikat tidak boleh kosong';
            $messages['tropi.mimes'] = 'Sertifikat harus memiliki format pdf, jpeg, png, jpg, webp';
            $messages['foto.required'] = 'Foto tidak boleh kosong';
            $messages['foto.mimes'] = 'Foto harus memiliki format jpeg, png, jpg';
            $messages['undangan.required'] = 'Surat undangan tidak boleh kosong';
            $messages['undangan.mimes'] = 'Surat undangan harus memiliki format pdf, jpeg, png, jpg';
        }

        $request->validate($rules, $messages);
    }
}
