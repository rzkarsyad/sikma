<?php

namespace App\Http\Controllers\Admin;

use App\Models\JalurMasuk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Master\JalurMasukDataTable;

class JalurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(JalurMasukDataTable $dataTable)
    {
        return $dataTable->render('admin.jalur-masuk');
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
        $this->validateJalur($request);

        JalurMasuk::create([
            'nama' => $request->nama,
        ]);

        return session()->flash('success', 'Data jalur masuk berhasil ditambah.');
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
        $jalur = JalurMasuk::findOrFail($id);
        return response()->json($jalur);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateJalur($request);

        $jalur = JalurMasuk::find($id);

        $jalur->update(['nama' => $request->nama]);

        return redirect()->route('admin.jalur-masuk')->with('success', 'Data jalur masuk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jalur = JalurMasuk::findOrFail($id);

        $jalur->delete();

        return redirect()->route('admin.jalur-masuk')->with('success', 'Data jalur masuk berhasil dihapus.');
    }

    public function validateJalur(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255|unique:jalur_masuk',
        ];

        $messages = [
            'nama.required' => 'Nama kegiatan tidak boleh kosong',
            'nama.unique' => 'Nama kegiatan sudah ada.',
        ];

        $request->validate($rules, $messages);
    }
}
