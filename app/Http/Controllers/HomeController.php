<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\MhsAktivitas;
use App\Models\MhsKegiatan;
use App\Models\MhsPrestasi;
use App\Models\MhsOrmawa;

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
        return view('admin.dashboard');
    }
}
