<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\ListJenis;
use App\Models\Mahasiswa;
use App\Models\MhsAgenda;
use App\Models\MhsOrmawa;
use App\Models\JalurMasuk;
use App\Models\ListAgenda;
use App\Models\ListOrmawa;
use App\Models\ListTingkat;
use App\Models\MhsKegiatan;
use App\Models\MhsPrestasi;
use App\Models\ListKategori;
use App\Models\ListKegiatan;
use App\Models\MhsAktivitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\DataTables\Dosen\AgendaDataTable;
use App\DataTables\Dosen\OrmawaDataTable;
use App\DataTables\Dosen\MandiriDataTable;
use App\DataTables\Dosen\PrestasiDataTable;
use App\DataTables\Dosen\AktivitasDataTable;
use App\DataTables\Master\MahasiswaDataTable;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        //
    }

    public function agenda(AgendaDataTable $dataTable)
    {
        $angkatan = $this->getAngkatan();
        $prodi = Prodi::pluck('nama', 'id');

        $jenis_agenda = ListAgenda::pluck('nama', 'id');

        $status = [
            1 => 'Belum Diterima',
            2 => 'Diterima',
        ];

        return $dataTable->render('dosen.agenda', compact('angkatan', 'prodi', 'jenis_agenda', 'status'));
    }

    public function showAgenda($id)
    {
        $mhsAgenda = MhsAgenda::findOrFail($id);

        $jenis_agenda = ListAgenda::pluck('nama', 'id');

        $status = [
            1 => 'Belum diterima',
            2 => 'Diterima',
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

        $jenis_agenda = $jenis_agenda[$mhsAgenda->jenis_agenda] ?? $mhsAgenda->jenis_agenda;

        $mahasiswa = $mhsAgenda->mahasiswa;
        $dosen = $mhsAgenda->dosen;
        $agendaDate = Carbon::createFromFormat('Y-m-d', $mhsAgenda->agenda_date)->locale('id')->isoFormat('D MMMM YYYY');

        return view('dosen.agenda-show')->with([
            'mhsAgenda' => $mhsAgenda,
            'jenis_agenda' => $jenis_agenda,
            'mahasiswa' => $mahasiswa,
            'dosen' => $dosen,
            'statusText' => $statusText,
            'badgeClass' => $badgeClass,
            'agendaDate' => $agendaDate,
        ]);
    }

    public function updateAgenda(Request $request, $id)
    {
        $this->validateAgenda($request);

        $mhsAgenda = MhsAgenda::findOrFail($id);

        $mhsAgenda->result = $request->result;
        $mhsAgenda->action = $request->action;
        $mhsAgenda->status = 2;

        $mhsAgenda->save();

        return redirect()->route('dosen.agenda')->with('success', 'Bimbingan berhasil ditinjau.');
    }

    public function aktivitas(AktivitasDataTable $dataTable)
    {
        $angkatan = $this->getAngkatan();
        $prodi = Prodi::pluck('nama', 'id');

        $kategori = ListKategori::pluck('nama', 'id');
        $kegiatan = ListKegiatan::pluck('nama', 'id');
        $tahun = $this->tahunDropdown();
        return $dataTable->render('dosen.aktivitas', compact('angkatan', 'prodi', 'kategori', 'kegiatan', 'tahun'));
    }

    public function showAktivitas($id)
    {
        $mhsAktivitas = MhsAktivitas::findOrFail($id);
        $mahasiswa = $mhsAktivitas->mahasiswa;
        $url = $mhsAktivitas->url_penyelenggara;
        if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
            $url = 'http://' . $url;
        }

        return view('dosen.aktivitas-show', compact('mhsAktivitas', 'mahasiswa', 'url'));
    }

    public function mandiri(MandiriDataTable $dataTable)
    {
        $angkatan = $this->getAngkatan();
        $prodi = Prodi::pluck('nama', 'id');

        $tingkat = ListTingkat::pluck('nama', 'id');
        $jenis = ListJenis::pluck('nama', 'id');

        return $dataTable->render('dosen.mandiri', compact('angkatan', 'prodi', 'tingkat', 'jenis'));
    }

    public function showMandiri($id)
    {
        $mhsKegiatan = MhsKegiatan::findOrFail($id);
        $mahasiswa = $mhsKegiatan->mahasiswa;
        $url = $mhsKegiatan->url_penyelenggara;
        if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
            $url = 'http://' . $url;
        }

        $tgl_mulai = Carbon::createFromFormat('Y-m-d', $mhsKegiatan->tanggal_mulai)->locale('id')->isoFormat('D MMMM YYYY');
        $tgl_selesai = Carbon::createFromFormat('Y-m-d', $mhsKegiatan->tanggal_selesai)->locale('id')->isoFormat('D MMMM YYYY');

        return view('dosen.mandiri-show', compact('mhsKegiatan', 'mahasiswa', 'url', 'tgl_mulai', 'tgl_selesai'));
    }

    public function prestasi(PrestasiDataTable $dataTable)
    {
        $angkatan = $this->getAngkatan();
        $prodi = Prodi::pluck('nama', 'id');

        $tingkat = ListTingkat::pluck('nama', 'id');

        return $dataTable->render('dosen.prestasi', compact('angkatan', 'prodi', 'tingkat'));
    }

    public function showPrestasi($id)
    {
        $mhsPrestasi = MhsPrestasi::findOrFail($id);
        $mahasiswa = $mhsPrestasi->mahasiswa;
        $url = $mhsPrestasi->url_penyelenggara;
        if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
            $url = 'http://' . $url;
        }

        $tgl_mulai = Carbon::createFromFormat('Y-m-d', $mhsPrestasi->tanggal_mulai)->locale('id')->isoFormat('D MMMM YYYY');
        $tgl_selesai = Carbon::createFromFormat('Y-m-d', $mhsPrestasi->tanggal_selesai)->locale('id')->isoFormat('D MMMM YYYY');

        return view('dosen.prestasi-show', compact('mhsPrestasi', 'mahasiswa', 'url', 'tgl_mulai', 'tgl_selesai'));
    }

    public function ormawa(OrmawaDataTable $dataTable)
    {
        $angkatan = $this->getAngkatan();
        $prodi = Prodi::pluck('nama', 'id');

        $ormawa = ListOrmawa::pluck('nama', 'id');

        return $dataTable->render('dosen.ormawa', compact('angkatan', 'prodi', 'ormawa'));
    }

    public function showOrmawa($id)
    {
        $mhsOrmawa = MhsOrmawa::findOrFail($id);
        $mahasiswa = $mhsOrmawa->mahasiswa;
        $url = $mhsOrmawa->url_media_ormawa;
        if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
            $url = 'http://' . $url;
        }
        return view('dosen.ormawa-show', compact('mhsOrmawa', 'mahasiswa', 'url'));
    }

    public function listMahasiswa(MahasiswaDataTable $dataTable)
    {
        $angkatan = $this->getAngkatan();
        $prodi = Prodi::pluck('nama', 'id');

        $jalur = JalurMasuk::pluck('nama', 'id');

        return $dataTable->render('dosen.mahasiswa', compact('angkatan', 'prodi', 'jalur'));
    }

    public function showMhs($id, AktivitasDataTable $dataTable)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $jenis_agenda = ListAgenda::pluck('nama', 'id');
        $status = [
            1 => 'Belum Diterima',
            2 => 'Diterima',
        ];

        $dataTable->setUserId($mahasiswa->user_id);

        return $dataTable->render('dosen.detail-mahasiswa', compact('mahasiswa', 'jenis_agenda', 'status'));
    }

    public function profile()
    {
        $dosen = Auth::user()->dosen;
        return view('dosen.profile', compact('dosen'));
    }

    public function changeContact(Request $request)
    {
        $request->validate( [
            'no_hp' => 'required',
        ]);

        $kPribadi = User::find(Auth::id());
        $kPribadi->dosen->no_hp = $request->input('no_hp');

        $kPribadi->dosen->save();

        return redirect()->back()->with('successUpdatePribadi', 'Kontak pribadi berhasil diupdate');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = User::find(Auth::id());

        $current = $user->password;

        if (!Hash::check($request->old_password, $current)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }

    public function validateAgenda(Request $request)
    {
        $rules = [
            'result' => 'required',
            'action' => 'required',
        ];

        $messages = [
            'result.required' => 'Hasil tidak boleh kosong',
            'action.required' => 'Tindak lanjut tidak boleh kosong',
        ];

        $request->validate($rules, $messages);
    }

    public function getAngkatan()
    {
        $currentYear = date('Y');
        $startYear = $currentYear - 15;
        $tahunMasukOptions = [];

        for ($year = $currentYear; $year >= $startYear; $year--) {
            $tahunMasukOptions[$year] = $year;
        }

        return $tahunMasukOptions;
    }

    public function tahunDropdown()
    {
        $currentYear = date('Y');
        $startYear = $currentYear - 15;
        $tahun = [];

        for ($year = $currentYear; $year >= $startYear; $year--) {
            $tahun[$year] = $year;
        }

        return $tahun;
    }
}
