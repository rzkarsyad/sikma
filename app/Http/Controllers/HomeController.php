<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Jenjang;
use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\MhsOrmawa;
use App\Models\JalurMasuk;
use App\Models\MhsKegiatan;
use App\Models\MhsPrestasi;
use App\Models\MhsAktivitas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dosenHome()
    {
        $cMahasiswa = Mahasiswa::count();
        $cKegiatan = MhsKegiatan::count();
        $cPrestasi = MhsPrestasi::count();
        $cOrmawa = MhsOrmawa::count();
        return view('dosen.dashboard', compact('cMahasiswa', 'cKegiatan', 'cPrestasi', 'cOrmawa'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $cMahasiswa = Mahasiswa::count();
        $cDosen = Dosen::count();
        $cJalur = JalurMasuk::count();
        $cJenjang = Jenjang::count();
        $cFakultas = Fakultas::count();
        $cProdi = Prodi::count();
        return view('admin.dashboard', compact('cMahasiswa', 'cDosen', 'cJalur', 'cJenjang', 'cFakultas', 'cProdi'));
    }
}
