<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Master\FakultasDataTable;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FakultasDataTable $dataTable)
    {
        return $dataTable->render('admin.fakultas');
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
        $this->validateFakultas($request);

        Fakultas::create([
            'nama' => $request->nama,
        ]);

        return session()->flash('success', 'Fakultas berhasil ditambah.');
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
        $fakultas = Fakultas::findOrFail($id);
        return response()->json($fakultas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateFakultas($request);

        $fakultas = Fakultas::find($id);

        $fakultas->update(['nama' => $request->nama]);

        return session()->flash('success', 'Fakultas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fakultas = Fakultas::findOrFail($id);

        $fakultas->delete();

        return redirect()->route('admin.fakultas')->with('success', 'Data fakultas berhasil dihapus.');
    }

    public function validateFakultas(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255|unique:fakultas',
        ];

        $messages = [
            'nama.required' => 'Nama kegiatan tidak boleh kosong',
            'nama.unique' => 'Nama kegiatan sudah ada.',
        ];

        $request->validate($rules, $messages);
    }
}
