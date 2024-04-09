<?php

namespace App\Http\Controllers\Admin;

use App\Models\ListAgenda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Master\ListAgendaDataTable;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListAgendaDataTable $dataTable)
    {
        return $dataTable->render('admin.agenda');
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
        $this->validateAgenda($request);

        ListAgenda::create([
            'nama' => $request->nama,
        ]);

        return session()->flash('success', 'Tipe agenda berhasil ditambah.');
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
        $agenda = ListAgenda::findOrFail($id);
        return response()->json($agenda);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateAgenda($request);

        $agenda = ListAgenda::find($id);

        $agenda->update(['nama' => $request->nama]);

        return session()->flash('success', 'Tipe agenda berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agenda = ListAgenda::findOrFail($id);

        $agenda->delete();

        return redirect()->route('admin.agenda')->with('success', 'Data agenda berhasil dihapus.');
    }

    public function validateAgenda(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255|unique:list_agenda',
        ];

        $messages = [
            'nama.required' => 'Nama agenda tidak boleh kosong',
            'nama.unique' => 'Nama agenda sudah ada.',
        ];

        $request->validate($rules, $messages);
    }
}
