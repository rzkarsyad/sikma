<?php

namespace App\Http\Controllers\Admin;

use App\Models\Prodi;
use App\Models\Jenjang;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Master\ProdiDataTable;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProdiDataTable $dataTable)
    {
        $jenjang = Jenjang::pluck('nama', 'id');
        $fakultas = Fakultas::pluck('nama', 'id');
        return $dataTable->render('admin.prodi', compact('jenjang', 'fakultas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateProdi($request);

        $existingProdi = Prodi::where('id_jenjang', $request->id_jenjang)
                              ->where('id_fakultas', $request->id_fakultas)
                              ->where('nama', $request->nama)
                              ->exists();

        if ($existingProdi) {
            return response()->json(['errors' => ['nama' => 'Program studi sudah ada.']], 422);
        }

        $newProdi = new Prodi();
        $newProdi->id_jenjang = $request->id_jenjang;
        $newProdi->id_fakultas = $request->id_fakultas;
        $newProdi->nama = $request->nama;

        $newProdi->save();

        return session()->flash('success', 'Program studi berhasil ditambah.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $prodi = Prodi::findOrFail($id);
        return response()->json($prodi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateProdi($request);

        $existingProdi = Prodi::where('id_jenjang', $request->id_jenjang)
                              ->where('id_fakultas', $request->id_fakultas)
                              ->where('nama', $request->nama)
                              ->exists();

        if ($existingProdi) {
            return response()->json(['errors' => ['nama' => 'Program studi sudah ada.']], 422);
        }

        $prodi = Prodi::find($id);

        $prodi->update([
            'id_jenjang' => $request->id_jenjang,
            'id_fakultas' => $request->id_fakultas,
            'nama' => $request->nama,
        ]);

        return session()->flash('success', 'Program studi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prodi = Prodi::findOrFail($id);

        $prodi->delete();

        return redirect()->route('admin.prodi')->with('success', 'Data program studi berhasil dihapus.');
    }

    public function validateProdi(Request $request)
    {
        $rules = [
            'id_jenjang' => 'required',
            'id_fakultas' => 'required',
            'nama' => 'required|string|max:255',
        ];

        $messages = [
            'id_jenjang.required' => 'Harap pilih jenjang',
            'id_fakultas.required' => 'Harap pilih fakultas',
            'nama.required' => 'Nama program studi tidak boleh kosong',
        ];

        $request->validate($rules, $messages);
    }
}
