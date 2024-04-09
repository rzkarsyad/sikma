<?php

namespace App\Http\Controllers;

use App\Models\MhsOrmawa;
use App\Models\ListOrmawa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\DataTables\Mahasiswa\MhsOrmawaDataTable;

class MhsOrmawaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MhsOrmawaDataTable $dataTable)
    {
        return $dataTable->render('mahasiswa.ormawa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ormawa = ListOrmawa::pluck('nama', 'id');

        $backRoute = route('m.ormawa');

        return view('mahasiswa.ormawa.create', compact('ormawa', 'backRoute'));
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

        $sk = $request->file('sk')->store('sk', 'public');

        $user = Auth::user();
        $nim = $user->mahasiswa->nim;
        $user_id = $user->id;

        MhsOrmawa::create([
            'user_id' => $user_id,
            'id_jenis_ormawa' => $request->id_jenis_ormawa,
            'nama_ormawa' => $request->nama_ormawa,
            'jabatan' => $request->jabatan,
            'masa_jabatan'=> $request->masa_jabatan,
            'sk'=> $sk,
            'url_media_ormawa'=>$request->url_media_ormawa,
        ]);

        return redirect()->route('m.ormawa')->with('success', 'Data ormawa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MhsOrmawa  $mhsOrmawa
     * @return \Illuminate\Http\Response
     */
    public function show(MhsOrmawa $mhsOrmawa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MhsOrmawa  $mhsOrmawa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mhsOrmawa = MhsOrmawa::findOrFail($id);
        $ormawa = ListOrmawa::pluck('nama', 'id');
        return view('mahasiswa.ormawa.edit', compact('mhsOrmawa', 'ormawa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MhsOrmawa  $mhsOrmawa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateAktivitas($request, false);

        $mhsOrmawa = MhsOrmawa::findOrFail($id);

        $mhsOrmawa->id_jenis_ormawa = $request->id_jenis_ormawa;
        $mhsOrmawa->nama_ormawa = $request->nama_ormawa;
        $mhsOrmawa->jabatan = $request->jabatan;
        $mhsOrmawa->masa_jabatan = $request->masa_jabatan;
        $mhsOrmawa->url_media_ormawa = $request->url_media_ormawa;

        if ($request->hasFile('sk')) {
            $pathS = $mhsOrmawa->sk;
            if ($pathS != null || $pathS != '') {
                Storage::disk('public')->delete($pathS);
            }
            $sk = $request->file('sk')->store('sk', 'public');
            $mhsOrmawa->sk = $sk;
        }

        $mhsOrmawa->save();

        return redirect()->route('m.ormawa')->with('success', 'Data ormawa & UKM berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MhsOrmawa  $mhsOrmawa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mhsOrmawa = MhsOrmawa::findOrFail($id);
        $sk = $mhsOrmawa->sk;

        if ($sk != null || $sk != '') {
            Storage::disk('public')->delete($sk);
        }

        $mhsOrmawa->delete();

        return redirect()->route('m.ormawa')->with('success', 'Data kegiatan berhasil dihapus.');
    }

    public function validateAktivitas(Request $request, $validateFotoSertifikat = true)
    {
        $rules = [
            'id_jenis_ormawa' => 'required',
            'nama_ormawa' => 'required',
            'jabatan' => 'required',
            'masa_jabatan' => 'required',
            'url_media_ormawa' => 'required',
        ];

        $messages = [
            'id_jenis_ormawa' => 'Tingkat tidak boleh kosong',
            'nama_ormawa' => 'Nama organisasi tidak boleh kosong',
            'jabatan' => 'Jabatan tidak boleh kosong',
            'masa_jabatan' => 'Masa Jabatan tidak boleh kosong',
            'url_media_ormawa' => 'URL tidak boleh kosong',
        ];

        if ($validateFotoSertifikat) {
            $rules['sk'] = 'required|file|mimes:pdf,jpeg,png,jpg,webp|max:2048';

            $messages['sk.required'] = 'SK Kepengurusan tidak boleh kosong';
            $messages['sk.mimes'] = 'SK Kepengurusan harus memiliki format pdf, jpeg, png, jpg, webp';
        }

        $request->validate($rules, $messages);
    }
}
