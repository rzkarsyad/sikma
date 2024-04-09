<?php

namespace App\Http\Controllers\Admin;

use App\Models\ListOrmawa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Master\ListOrmawaDataTable;

class OrmawaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListOrmawaDataTable $dataTable)
    {
        return $dataTable->render('admin.ormawa');
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
        $this->validateOrmawa($request);

        ListOrmawa::create([
            'nama' => $request->nama,
        ]);

        return session()->flash('success', 'Organisasi / UKM berhasil ditambah.');
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
        $ormawa = ListOrmawa::findOrFail($id);
        return response()->json($ormawa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateOrmawa($request);

        $ormawa = ListOrmawa::find($id);

        $ormawa->update(['nama' => $request->nama]);

        return session()->flash('success', 'Organisasi/UKM berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ormawa = ListOrmawa::findOrFail($id);

        $ormawa->delete();

        return redirect()->route('admin.ormawa')->with('success', 'Data organisasi berhasil dihapus.');
    }

    public function validateOrmawa(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255|unique:list_ormawa',
        ];

        $messages = [
            'nama.required' => 'Nama kegiatan tidak boleh kosong',
            'nama.unique' => 'Nama kegiatan sudah ada.',
        ];

        $request->validate($rules, $messages);
    }
}
