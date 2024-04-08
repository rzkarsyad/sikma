<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\MhsAgenda;
use App\Models\ListAgenda;
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
        $jenis_agenda = ListAgenda::pluck('nama', 'id');
        $dosen = Dosen::pluck('nama', 'nidn');

        $backRoute = route('m.agenda');

        return view('mahasiswa.agenda.create', compact('jenis_agenda', 'dosen', 'backRoute'));
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
            'id_agenda' => $request->id_agenda,
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
    public function show($id)
    {
        $mhsAgenda = MhsAgenda::findOrFail($id);

        $status = [
            1 => 'Belum ditinjau',
            2 => 'Sudah ditinjau',
        ];

        $statusText = $status[$mhsAgenda->status] ?? $mhsAgenda->status;
        $badgeClass = '';

        switch ($mhsAgenda->status) {
            case 1:
                $badgeClass = 'text-bg-danger';
                break;
            case 2:
                $badgeClass = 'text-bg-success';
                break;
            default:
                $badgeClass = 'text-bg-secondary';
                break;
        }

        $jenis_agenda = ListAgenda::pluck('nama', 'id');

        $jenis_agenda = $jenis_agenda[$mhsAgenda->jenis_agenda] ?? $mhsAgenda->jenis_agenda;

        return view('mahasiswa.agenda.show')->with([
            'statusText' => $statusText,
            'badgeClass' => $badgeClass,
            'mhsAgenda' => $mhsAgenda,
            'jenis_agenda' => $jenis_agenda,
        ]);
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

        $jenis_agenda = ListAgenda::pluck('nama', 'id');

        $dosen = Dosen::pluck('nama', 'nidn');
        return view('mahasiswa.agenda.edit', compact('dosen', 'jenis_agenda', 'mhsAgenda'));
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

        $mhsAgenda->id_agenda = $request->id_agenda;
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
            'id_agenda' => 'required',
            'agenda_date' => 'required',
            'agenda_time' => 'required',
            'dosen_id' => 'required',
            'topic' => 'required',
            'content' => 'required',
        ];

        $messages = [
            'id_agenda.required' => 'Jenis bimbingan tidak boleh kosong',
            'agenda_date.required' => 'Tanggal tidak boleh kosong',
            'agenda_time.required' => 'Waktu tidak boleh kosong',
            'dosen_id.required' => 'Dosen pembimbing tidak boleh kosong',
            'topic.required' => 'Judul tidak boleh kosong',
            'content.required' => 'Isi tidak boleh kosong',
        ];

        $request->validate($rules, $messages);
    }
}
