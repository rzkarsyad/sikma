<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\ListAgenda;
use App\Exports\DosenExport;
use App\Imports\DosenImport;
use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\Master\DosenDataTable;
use App\DataTables\Master\ProdiDataTable;
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

    public function agenda(ListAgendaDataTable $dataTable){
        return $dataTable->render('admin.agenda');
    }

    public function editAgenda($id)
    {
        //
    }

    public function updateAgenda(Request $request, $id)
    {
        //
    }

    public function deleteAgenda($id)
    {
        //
    }

    public function kegiatan(KegiatanDataTable $dataTable){
        return $dataTable->render('admin.kegiatan');
    }

    public function editKegiatan($id)
    {
        //
    }

    public function updateKegiatan(Request $request, $id)
    {
        //
    }

    public function deleteKegiatan($id)
    {
        //
    }

    public function ormawa(ListOrmawaDataTable $dataTable){
        return $dataTable->render('admin.ormawa');
    }

    public function editOrganisasi($id)
    {
        //
    }

    public function updateOrganisasi(Request $request, $id)
    {
        //
    }

    public function deleteOrganisasi($id)
    {
        //
    }

    public function jalurMasuk(JalurMasukDataTable $dataTable){
        return $dataTable->render('admin.jalur-masuk');
    }

    public function prodi(ProdiDataTable $dataTable){
        return $dataTable->render('admin.prodi');
    }

    public function fakultas(FakultasDataTable $dataTable){
        return $dataTable->render('admin.fakultas');
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
}
