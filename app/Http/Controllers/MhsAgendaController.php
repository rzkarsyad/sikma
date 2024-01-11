<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\MhsAgenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataTables\Mahasiswa\MhsAgendaDataTable;

class MhsAgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MhsAgendaDataTable $dataTable)
    {
        return $dataTable->render('mahasiswa.agenda.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_bimbingan = [
            1 => 'Bimbingan Konseling',
            2 => 'Bimbingan Pembina Ormawa',
        ];
        $dosen = Dosen::pluck('nama', 'nidn');
        return view('mahasiswa.agenda.create', compact('dosen', 'jenis_bimbingan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateAgenda($request);
        
        $user = Auth::user();
        $nim = $user->mahasiswa->nim;
        $user_id = $user->id;

        MhsAgenda::create([
            'user_id' => $user_id,
            'type' => $request->type,
            'agenda_date' => $request->agenda_date,
            'agenda_time' => $request->agenda_time,
            'dosen_id' => $request->dosen_id,
            'topic' => $request->topic,
            'content' => $request->content,
        ]);

        return redirect()->route('m.agenda')->with('success', 'Bimbingan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MhsAgenda  $mhsAgenda
     * @return \Illuminate\Http\Response
     */
    public function show(MhsAgenda $mhsAgenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MhsAgenda  $mhsAgenda
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mhsAgenda = MhsAgenda::findOrFail($id);
        $jenis_bimbingan = [
            1 => 'Bimbingan Konseling',
            2 => 'Bimbingan Pembina Ormawa',
        ];
        $dosen = Dosen::pluck('nama', 'nidn');
        return view('mahasiswa.agenda.edit', compact('dosen', 'jenis_bimbingan', 'mhsAgenda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MhsAgenda  $mhsAgenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateAgenda($request);

        $mhsAgenda = MhsAgenda::findOrFail($id);

        $mhsAgenda->type = $request->type;
        $mhsAgenda->agenda_date = $request->agenda_date;
        $mhsAgenda->agenda_time = $request->agenda_time;
        $mhsAgenda->dosen_id = $request->dosen_id;
        $mhsAgenda->topic = $request->topic;
        $mhsAgenda->content = $request->content;

        $mhsAgenda->save();

        return redirect()->route('m.agenda')->with('success', 'Bimbingan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MhsAgenda  $mhsAgenda
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mhsAgenda = MhsAgenda::findOrFail($id);

        $mhsAgenda->delete();

        return redirect()->route('m.agenda')->with('success', 'Bimbingan berhasil dihapus.');
    }

    public function validateAgenda(Request $request)
    {
        $rules = [
            'type' => 'required',
            'agenda_date' => 'required',
            'agenda_time' => 'required',
            'dosen_id' => 'required',
            'topic' => 'required',
            'content' => 'required',
        ];

        $messages = [
            'type.required' => 'Jenis bimbingan tidak boleh kosong',
            'agenda_date.required' => 'Tanggal tidak boleh kosong',
            'agenda_time.required' => 'Waktu tidak boleh kosong',
            'dosen_id.required' => 'Dosen pembimbing tidak boleh kosong',
            'topic.required' => 'Judul tidak boleh kosong',
            'content.required' => 'Isi tidak boleh kosong',
        ];

        $request->validate($rules, $messages);
    }
}
