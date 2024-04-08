<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Jenjang;
use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\JalurMasuk;
use App\Models\ListAgenda;
use App\Models\ListOrmawa;
use App\Exports\DosenExport;
use App\Imports\DosenImport;
use App\Models\ListKegiatan;
use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\Master\AdminDataTable;
use App\DataTables\Master\DosenDataTable;
use App\DataTables\Master\ProdiDataTable;
use App\DataTables\Master\JenjangDataTable;
use App\DataTables\Master\FakultasDataTable;
use App\DataTables\Master\KegiatanDataTable;
use App\DataTables\Master\MahasiswaDataTable;
use App\DataTables\Master\JalurMasukDataTable;
use App\DataTables\Master\ListAgendaDataTable;
use App\DataTables\Master\ListOrmawaDataTable;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('admin.index');
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
        $this->validateAdmin($request);

        $user = User::create([
            'nim_nidn' => $request->nim_nidn,
            'email' => $request->email,
            'password' => Hash::make($request->nim_nidn),
            'type' => 2,
        ]);

        return session()->flash('success', 'Admin berhasil ditambah.');
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
        $admin = User::findOrFail($id);

        $admin->delete();

        return redirect()->route('admin.member')->with('success', 'Admin berhasil dihapus.');
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

            $mhs->update([
                'user_id' => $user->id,
            ]);
        } else {
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

                $dosen->update([
                    'user_id' => $user->id,
                ]);
            } else {
                if ($dosen->user_id !== $existingUser->id) {
                    $dosen->update([
                        'user_id' => $existingUser->id,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Data dosen berhasil digenerate user.');;
    }

    public function resetPassword($id) {

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        }

        $password = $user->nim_nidn;

        $hashedPassword = Hash::make($password);

        $user->password = $hashedPassword;

        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil disetel ulang.');
    }

    public function validateAdmin(Request $request)
    {
        $rules = [
            'nim_nidn' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255'
        ];

        $messages = [
            'nim_nidn.required' => 'Username tidak boleh kosong',
            'nim_nidn.unique' => 'Username sudah ada.',

            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',

            'password.required' => 'Kata sandi tidak boleh kosong',
        ];

        $request->validate($rules, $messages);
    }
}
