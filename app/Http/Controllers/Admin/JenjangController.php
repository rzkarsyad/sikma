<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jenjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Master\JenjangDataTable;

class JenjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JenjangDataTable $dataTable)
    {
        return $dataTable->render('admin.jenjang');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateJenjang($request);

        Jenjang::create([
            'nama' => $request->nama,
        ]);

        return session()->flash('success', 'Data jenjang berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jenjang  $jenjang
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jenjang  $jenjang
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $jalur = Jenjang::findOrFail($id);
        return response()->json($jalur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jenjang  $jenjang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $this->validateJenjang($request);

        $jalur = Jenjang::find($id);

        $jalur->update(['nama' => $request->nama]);

        return redirect()->route('admin.jenjang')->with('success', 'Data jenjang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jenjang  $jenjang
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $jalur = Jenjang::findOrFail($id);

        $jalur->delete();

        return redirect()->route('admin.jenjang')->with('success', 'Data jenjang berhasil dihapus.');
    }

    public function validateJenjang(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255|unique:jenjang',
        ];

        $messages = [
            'nama.required' => 'Jenjang tidak boleh kosong',
            'nama.unique' => 'Jenjang sudah ada.',
        ];

        $request->validate($rules, $messages);
    }
}
