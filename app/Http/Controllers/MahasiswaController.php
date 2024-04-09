<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\MhsOrmawa;
use App\Models\MhsKegiatan;
use App\Models\MhsPrestasi;
use App\Models\MhsAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cAktivitas = MhsAktivitas::where('user_id', Auth::user()->id)->count();
        $cKegiatan = MhsKegiatan::where('user_id', Auth::user()->id)->count();
        $cPrestasi = MhsPrestasi::where('user_id', Auth::user()->id)->count();
        $cOrmawa = MhsOrmawa::where('user_id', Auth::user()->id)->count();
        return view('mahasiswa.dashboard', compact('cAktivitas', 'cKegiatan', 'cPrestasi', 'cOrmawa'));
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

    public function profile()
    {
        $months = $this->monthsIND();
        $tanggalLahir = Auth::user()->mahasiswa->tgl_lahir;
        $tglLahir = date('d', strtotime($tanggalLahir)).' '.$months[date('n', strtotime($tanggalLahir))].' '.date('Y', strtotime($tanggalLahir));

        session(['active_tab' => 'data-pribadi']);

        return view('mahasiswa.change-profile', compact('tglLahir'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function monthsIND()
    {
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        return $months;
    }

    public function ubahKontakPribadi(Request $request)
    {
        $request->validate( [
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        session(['active_tab' => 'kontak-pribadi']);

        $kPribadi = User::find(Auth::id());
        $kPribadi->mahasiswa->no_hp = $request->input('no_hp');
        $kPribadi->mahasiswa->alamat = $request->input('alamat');

        $kPribadi->mahasiswa->save();

        return redirect()->back()->with('successUpdatePribadi', 'Kontak pribadi berhasil diperbarui');
    }

    public function ubahKontakDarurat(Request $request)
    {

        $request->validate( [
            'nama_ortu' => 'required',
            'hubungan_ortu' => 'required',
            'no_hp_ortu' => 'nullable',
        ]);

        session(['active_tab' => 'kontak-darurat']);

        $kDarurat = User::find(Auth::id());

        $kDarurat->mahasiswa->nama_ortu = $request->input('nama_ortu');
        $kDarurat->mahasiswa->hubungan_ortu = $request->input('hubungan_ortu');
        $kDarurat->mahasiswa->no_hp_ortu = $request->input('no_hp_ortu');

        $kDarurat->mahasiswa->save();

        return redirect()->back()->with('successUpdateDarurat', 'Kontak darurat berhasil diperbarui');
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        session(['active_tab' => 'ganti-sandi']);

        $user = User::find(Auth::id());

        $current = $user->password;

        if (!Hash::check($request->old_password, $current)) {
            return redirect()->back()->with('error', 'Kata sandi saat ini salah.');
        }

        if ($request->new_password !== $request->new_password_confirmation) {
            return redirect()->back()->with('error', 'Kata sandi baru dan konfirmasi tidak cocok.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diubah.');
    }
}
