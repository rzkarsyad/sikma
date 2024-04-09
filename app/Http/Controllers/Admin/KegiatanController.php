<?php

namespace App\Http\Controllers\Admin;

use App\Models\ListKegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Master\KegiatanDataTable;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(KegiatanDataTable $dataTable)
    {
        return $dataTable->render('admin.kegiatan');
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
        $this->validateKegiatan($request);

        ListKegiatan::create([
            'nama' => $request->nama,
        ]);

        return session()->flash('success', 'Kegiatan berhasil ditambah.');
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
        $kegiatan = ListKegiatan::findOrFail($id);
        return response()->json($kegiatan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateKegiatan($request);

        $kegiatan = ListKegiatan::find($id);

        $kegiatan->update(['nama' => $request->nama]);

        return session()->flash('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kegiatan = ListKegiatan::findOrFail($id);

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan')->with('success', 'Data kegiatan berhasil dihapus.');
    }

    public function validateKegiatan(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255|unique:list_kegiatan',
        ];

        $messages = [
            'nama.required' => 'Nama kegiatan tidak boleh kosong',
            'nama.unique' => 'Nama kegiatan sudah ada.',
        ];

        $request->validate($rules, $messages);
    }
}
