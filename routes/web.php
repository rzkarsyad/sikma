<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MhsOrmawaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MhsAgendaController;
use App\Http\Controllers\MhsKegiatanController;
use App\Http\Controllers\MhsPrestasiController;
use App\Http\Controllers\MhsAktivitasController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->middleware(['guest:'.config('fortify.guard')]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
});

Auth::routes(['register' => false]);

// Mahasiswa Route List
Route::middleware(['auth', 'user-access:mahasiswa'])->group(function () {
   
    Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('m.dashboard');

    Route::get('/agenda', [MhsAgendaController::class, 'index'])->name('m.agenda');
    Route::get('/agenda/show/{id}', [MhsAgendaController::class, 'show'])->name('m.agenda-show');
    Route::get('/agenda/create', [MhsAgendaController::class, 'create'])->name('m.agenda-create');
    Route::post('/agenda/store', [MhsAgendaController::class, 'store'])->name('m.agenda-store');
    Route::get('/agenda/edit/{id}', [MhsAgendaController::class, 'edit'])->name('m.agenda-edit');
    Route::put('/agenda/update/{id}', [MhsAgendaController::class, 'update'])->name('m.agenda-update');
    Route::delete('/agenda/delete/{id}', [MhsAgendaController::class, 'destroy'])->name('m.agenda-delete');

    Route::get('/aktivitas', [MhsAktivitasController::class, 'index'])->name('m.aktivitas');
    Route::get('/aktivitas/create', [MhsAktivitasController::class, 'create'])->name('m.aktivitas-create');
    Route::post('/aktivitas/store', [MhsAktivitasController::class, 'store'])->name('m.aktivitas-store');
    Route::get('/aktivitas/edit/{id}', [MhsAktivitasController::class, 'edit'])->name('m.aktivitas-edit');
    Route::put('/aktivitas/update/{id}', [MhsAktivitasController::class, 'update'])->name('m.aktivitas-update');
    Route::delete('/aktivitas/delete/{id}', [MhsAktivitasController::class, 'destroy'])->name('m.aktivitas-delete');

    Route::get('/kegiatan-mandiri', [MhsKegiatanController::class, 'index'])->name('m.mandiri');
    Route::get('/kegiatan-mandiri/show/{id}', [MhsKegiatanController::class, 'show'])->name('m.mandiri-show');
    Route::get('/kegiatan-mandiri/create', [MhsKegiatanController::class, 'create'])->name('m.mandiri-create');
    Route::post('/kegiatan-mandiri/store', [MhsKegiatanController::class, 'store'])->name('m.mandiri-store');
    Route::get('/kegiatan-mandiri/edit/{id}', [MhsKegiatanController::class, 'edit'])->name('m.mandiri-edit');
    Route::put('/kegiatan-mandiri/update/{id}', [MhsKegiatanController::class, 'update'])->name('m.mandiri-update');
    Route::delete('/kegiatan-mandiri/delete/{id}', [MhsKegiatanController::class, 'destroy'])->name('m.mandiri-delete');
    
    Route::get('/prestasi', [MhsPrestasiController::class, 'index'])->name('m.prestasi');
    Route::get('/prestasi/show/{id}', [MhsPrestasiController::class, 'show'])->name('m.prestasi-show');
    Route::get('/prestasi/create', [MhsPrestasiController::class, 'create'])->name('m.prestasi-create');
    Route::post('/prestasi/store', [MhsPrestasiController::class, 'store'])->name('m.prestasi-store');
    Route::get('/prestasi/edit/{id}', [MhsPrestasiController::class, 'edit'])->name('m.prestasi-edit');
    Route::put('/prestasi/update/{id}', [MhsPrestasiController::class, 'update'])->name('m.prestasi-update');
    Route::delete('/prestasi/delete/{id}', [MhsPrestasiController::class, 'destroy'])->name('m.prestasi-delete');

    Route::get('/ormawa', [MhsOrmawaController::class, 'index'])->name('m.ormawa');
    Route::get('/ormawa/create', [MhsOrmawaController::class, 'create'])->name('m.ormawa-create');
    Route::post('/ormawa/store', [MhsOrmawaController::class, 'store'])->name('m.ormawa-store');
    Route::get('/ormawa/edit/{id}', [MhsOrmawaController::class, 'edit'])->name('m.ormawa-edit');
    Route::put('/ormawa/update/{id}', [MhsOrmawaController::class, 'update'])->name('m.ormawa-update');
    Route::delete('/ormawa/delete/{id}', [MhsOrmawaController::class, 'destroy'])->name('m.ormawa-delete');

    Route::get('/profil', [MahasiswaController::class, 'profil'])->name('m.profil');

    Route::post('/change-password', [MahasiswaController::class, 'changePassword'])->name('change.password');
    Route::post('/ubah-kontak-pribadi', [MahasiswaController::class, 'ubahKontakPribadi'])->name('ubah.kontak.pribadi');
    Route::post('/ubah-kontak-darurat', [MahasiswaController::class, 'ubahKontakDarurat'])->name('ubah.kontak.darurat');

});
   
// Dosen Routes List
Route::middleware(['auth', 'user-access:dosen'])->group(function () {
   
    Route::get('/dosen/dashboard', [HomeController::class, 'dosenHome'])->name('dosen.home');
    Route::get('/dosen/agenda', [DosenController::class, 'agenda'])->name('dosen.agenda');
    Route::get('/dosen/agenda/show/{id}', [DosenController::class, 'showAgenda'])->name('dosen.agenda.show');
    Route::get('/dosen/agenda/store', [DosenController::class, 'storeAgenda'])->name('dosen.agenda.store');
    Route::get('/dosen/aktivitas', [DosenController::class, 'aktivitas'])->name('dosen.aktivitas');
    Route::get('/dosen/mandiri', [DosenController::class, 'mandiri'])->name('dosen.mandiri');
    Route::get('/dosen/prestasi', [DosenController::class, 'prestasi'])->name('dosen.prestasi');
    Route::get('/dosen/ormawa', [DosenController::class, 'ormawa'])->name('dosen.ormawa');
    Route::get('/dosen/mahasiswa', [DosenController::class, 'listMahasiswa'])->name('dosen.mahasiswa');

    Route::get('/dosen/mahasiswa/{id}', [DosenController::class, 'showMhs'])->name('dosen.show.mahasiswa');
});

// Admin Route List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/dashboard', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/kegiatan', [AdminController::class, 'kegiatan'])->name('admin.kegiatan');
    Route::get('/admin/ormawa', [AdminController::class, 'ormawa'])->name('admin.ormawa');
    Route::get('/admin/jalur-masuk', [AdminController::class, 'jalurMasuk'])->name('admin.jalur-masuk');
    Route::get('/admin/prodi', [AdminController::class, 'prodi'])->name('admin.prodi');
    Route::get('/admin/fakultas', [AdminController::class, 'fakultas'])->name('admin.fakultas');
    Route::get('/admin/mahasiswa', [AdminController::class, 'mahasiswa'])->name('admin.mahasiswa');
    Route::get('/admin/mahasiswa/export', [AdminController::class, 'mahasiswaExport'])->name('admin.mahasiswa.export');
    Route::post('/admin/mahasiswa/import', [AdminController::class, 'mahasiswaImport'])->name('admin.mahasiswa.import');
    Route::get('/admin/mahasiswa/generate', [AdminController::class, 'generateMhs'])->name('admin.mahasiswa.generate');
    Route::get('/admin/dosen', [AdminController::class, 'dosen'])->name('admin.dosen');
    Route::get('/admin/dosen/export', [AdminController::class, 'dosenExport'])->name('admin.dosen.export');
    Route::post('/admin/dosen/import', [AdminController::class, 'dosenImport'])->name('admin.dosen.import');
    Route::get('/admin/dosen/generate', [AdminController::class, 'generateDosen'])->name('admin.dosen.generate');
});