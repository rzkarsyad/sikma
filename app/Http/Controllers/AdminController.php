<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Exports\DosenExport;
use App\Imports\DosenImport;
use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\Master\MahasiswaDataTable;
use App\DataTables\Master\DosenDataTable;

class AdminController extends Controller
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

    public function kegiatan(){
        return view('admin.kegiatan');
    }

    public function ormawa(){
        return view('admin.ormawa');
    }

    public function jalurMasuk(){
        return view('admin.jalur-masuk');
    }

    public function prodi(){
        return view('admin.prodi');
    }

    public function fakultas(){
        return view('admin.fakultas');
    }
    
    public function mahasiswa(MahasiswaDataTable $dataTable)
    {
        return $dataTable->render('admin.mahasiswa');
    }

    public function dosen(DosenDataTable $dataTable)
    {
        return $dataTable->render('admin.dosen');
    }

    public function mahasiswaExport(){
        $mahasiswa = Mahasiswa::all();

        if ($mahasiswa->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data yang tersedia.');
        }else{
            return Excel::download(new MahasiswaExport, 'mahasiswa-unaic.xlsx');
        }
    }

    public function mahasiswaImport(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new MahasiswaImport, $request->file('file'));

        return redirect()->back();
    }

    public function generateMhs(){
    
    $mahasiswa = Mahasiswa::all();

    foreach ($mahasiswa as $mhs) {
        $existingUser = User::where('nim_nidn', $mhs->nim)->first();

        if (!$existingUser) {
            $user = User::create([
                'nim_nidn' => $mhs->nim,
                'email' => $mhs->email_kampus,
                'password' => Hash::make($mhs->nim),
                'type' => 0,
            ]);

            // Update user_id in mahasiswa table
            $mhs->update([
                'user_id' => $user->id,
            ]);
        } else {
            // Update user_id in mahasiswa table if it's different
            if ($mhs->user_id !== $existingUser->id) {
                $mhs->update([
                    'user_id' => $existingUser->id,
                ]);
            }
        }
    }

        return redirect()->back()->with('success', 'Data mahasiswa berhasil digenerate user.');;
    }

    public function dosenExport(){
        $dosen = Dosen::all();

        if ($dosen->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data yang tersedia.');
        }else{
            return Excel::download(new DosenExport, 'dosen-unaic.xlsx');
        }
    }

    public function dosenImport(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new DosenImport, $request->file('file'));

        return redirect()->back();
    }

    public function generateDosen(){
        $dosen = Dosen::all();

        if ($dosen->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data yang tersedia.');
        }

        foreach ($dosen as $dosen) {
            $existingUser = User::where('nim_nidn', $dosen->nidn)->first();

            if (!$existingUser) {
                $user = User::create([
                    'nim_nidn' => $dosen->nidn,
                    'email' => $dosen->email,
                    'password' => Hash::make($dosen->nim),
                    'type' => 0,
                ]);

                // Update user_id in mahasiswa table
                $dosen->update([
                    'user_id' => $user->id,
                ]);
            } else {
                // Update user_id in mahasiswa table if it's different
                if ($dosen->user_id !== $existingUser->id) {
                    $dosen->update([
                        'user_id' => $existingUser->id,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Data dosen berhasil digenerate user.');;
    }
}
