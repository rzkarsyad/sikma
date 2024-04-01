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

    public function storeAgenda(Request $request)
    {
        $this->validateAgenda($request);

        ListAgenda::create([
            'nama' => $request->nama,
        ]);

        return session()->flash('success', 'Data agenda berhasil ditambah.');
    }

    public function editAgenda($id)
    {
        $agenda = ListAgenda::findOrFail($id);
        return response()->json($agenda);
    }

    public function updateAgenda(Request $request, $id)
    {
        $this->validateAgenda($request);

        $agenda = ListAgenda::find($id);

        $agenda->update(['nama' => $request->nama]);

        return redirect()->route('admin.agenda')->with('success', 'Data agenda berhasil diperbarui.');
    }

    public function deleteAgenda($id)
    {
        $agenda = ListAgenda::findOrFail($id);

        $agenda->delete();

        return redirect()->route('admin.agenda')->with('success', 'Data agenda berhasil dihapus.');
    }

    public function kegiatan(KegiatanDataTable $dataTable){
        return $dataTable->render('admin.kegiatan');
    }

    public function storeKegiatan(Request $request)
    {
        $this->validateKegiatan($request);

        ListKegiatan::create([
            'nama' => $request->nama,
        ]);

        return session()->flash('success', 'Data kegiatan berhasil ditambah.');
    }

    public function editKegiatan($id)
    {
        $kegiatan = ListKegiatan::findOrFail($id);
        return response()->json($kegiatan);
    }

    public function updateKegiatan(Request $request, $id)
    {
        $this->validateKegiatan($request);

        $kegiatan = ListKegiatan::find($id);

        $kegiatan->update(['nama' => $request->nama]);

        return redirect()->route('admin.kegiatan')->with('success', 'Data kegiatan berhasil diperbarui.');
    }

    public function deleteKegiatan($id)
    {
        $kegiatan = ListKegiatan::findOrFail($id);

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan')->with('success', 'Data kegiatan berhasil dihapus.');
    }

    public function ormawa(ListOrmawaDataTable $dataTable){
        return $dataTable->render('admin.ormawa');
    }

    public function storeOrmawa(Request $request)
    {
        $this->validateOrmawa($request);

        ListOrmawa::create([
            'nama' => $request->nama,
        ]);

        return session()->flash('success', 'Data organisasi berhasil ditambah.');
    }

    public function editOrganisasi($id)
    {
        $ormawa = ListOrmawa::findOrFail($id);
        return response()->json($ormawa);
    }

    public function updateOrganisasi(Request $request, $id)
    {
        $this->validateOrmawa($request);

        $ormawa = ListOrmawa::find($id);

        $ormawa->update(['nama' => $request->nama]);

        return redirect()->route('admin.ormawa')->with('success', 'Data organisasi berhasil diperbarui.');
    }

    public function deleteOrganisasi($id)
    {
        $ormawa = ListOrmawa::findOrFail($id);

        $ormawa->delete();

        return redirect()->route('admin.ormawa')->with('success', 'Data organisasi berhasil dihapus.');
    }

    public function jalurMasuk(JalurMasukDataTable $dataTable){
        return $dataTable->render('admin.jalur-masuk');
    }

    public function storeJalur(Request $request){
        $this->validateJalur($request);

        JalurMasuk::create([
            'nama' => $request->nama,
        ]);

        return session()->flash('success', 'Data jalur masuk berhasil ditambah.');
    }

    public function editJalur($id){
        $jalur = JalurMasuk::findOrFail($id);
        return response()->json($jalur);
    }

    public function updateJalur(Request $request, $id){
        $this->validateJalur($request);

        $jalur = JalurMasuk::find($id);

        $jalur->update(['nama' => $request->nama]);

        return redirect()->route('admin.jalur-masuk')->with('success', 'Data jalur masuk berhasil diperbarui.');
    }

    public function deleteJalur($id){
        $jalur = JalurMasuk::findOrFail($id);

        $jalur->delete();

        return redirect()->route('admin.jalur-masuk')->with('success', 'Data jalur masuk berhasil dihapus.');
    }

    public function prodi(ProdiDataTable $dataTable){
        $jenjang = Jenjang::pluck('nama', 'id');
        $fakultas = Fakultas::pluck('nama', 'id');
        return $dataTable->render('admin.prodi', compact('jenjang', 'fakultas'));
    }

    public function storeProdi(Request $request){
        $this->validateProdi($request);

        Prodi::create([
            'nama' => $request->nama,
            'id_jenjang' => $request->id_jenjang,
            'id_fakultas' => $request->id_fakultas,
        ]);

        return session()->flash('success', 'Data program studi berhasil ditambah.');
    }

    public function editProdi($id){
        $prodi = Prodi::findOrFail($id);
        return response()->json($prodi);
    }

    public function updateProdi(Request $request, $id){
        $this->validateProdi($request);

        $prodi = Prodi::find($id);

        $prodi->update(['nama' => $request->nama]);

        return redirect()->route('admin.prodi')->with('success', 'Data program studi berhasil diperbarui.');
    }

    public function deleteProdi($id){
        $prodi = Prodi::findOrFail($id);

        $prodi->delete();

        return redirect()->route('admin.prodi')->with('success', 'Data program studi berhasil dihapus.');
    }

    public function fakultas(FakultasDataTable $dataTable){
        return $dataTable->render('admin.fakultas');
    }

    public function storeFakultas(Request $request){
        $this->validateFakultas($request);

        Fakultas::create([
            'nama' => $request->nama,
        ]);

        return session()->flash('success', 'Data fakultas berhasil ditambah.');
    }

    public function editFakultas($id){
        $fakultas = Fakultas::findOrFail($id);
        return response()->json($fakultas);
    }

    public function updateFakultas(Request $request, $id){
        $this->validateFakultas($request);

        $fakultas = Fakultas::find($id);

        $fakultas->update(['nama' => $request->nama]);

        return redirect()->route('admin.fakultas')->with('success', 'Data fakultas berhasil diperbarui.');
    }

    public function deleteFakultas($id){
        $fakultas = Fakultas::findOrFail($id);

        $fakultas->delete();

        return redirect()->route('admin.fakultas')->with('success', 'Data fakultas berhasil dihapus.');
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

    public function validateAgenda(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255|unique:list_agenda',
        ];

        $messages = [
            'nama.required' => 'Nama agenda tidak boleh kosong',
            'nama.unique' => 'Nama agenda sudah ada.',
        ];

        $request->validate($rules, $messages);
    }

    public function validateKegiatan(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255|unique:list_kegiatan',
        ];

        $messages = [
            'nama.required' => 'Nama kegiatan tidak boleh kosong',
            'nama.unique' => 'Nama kegiatan sudah ada.',
        ];

        $request->validate($rules, $messages);
    }

    public function validateOrmawa(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255|unique:list_ormawa',
        ];

        $messages = [
            'nama.required' => 'Nama kegiatan tidak boleh kosong',
            'nama.unique' => 'Nama kegiatan sudah ada.',
        ];

        $request->validate($rules, $messages);
    }

    public function validateJalur(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255|unique:jalur_masuk',
        ];

        $messages = [
            'nama.required' => 'Nama kegiatan tidak boleh kosong',
            'nama.unique' => 'Nama kegiatan sudah ada.',
        ];

        $request->validate($rules, $messages);
    }

    public function validateProdi(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255|unique:prodi',
        ];

        $messages = [
            'nama.required' => 'Nama kegiatan tidak boleh kosong',
            'nama.unique' => 'Nama kegiatan sudah ada.',
        ];

        $request->validate($rules, $messages);
    }

    public function validateFakultas(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255|unique:fakultas',
        ];

        $messages = [
            'nama.required' => 'Nama kegiatan tidak boleh kosong',
            'nama.unique' => 'Nama kegiatan sudah ada.',
        ];

        $request->validate($rules, $messages);
    }
}
