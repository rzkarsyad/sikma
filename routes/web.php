<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MhsAgendaController;
use App\Http\Controllers\MhsOrmawaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\JalurController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\MhsKegiatanController;
use App\Http\Controllers\MhsPrestasiController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\OrmawaController;
use App\Http\Controllers\MhsAktivitasController;
use App\Http\Controllers\Admin\JenjangController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\KegiatanController;
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

    Route::get('/profile', [MahasiswaController::class, 'profile'])->name('m.profile');

    Route::post('/change-password', [MahasiswaController::class, 'changePassword'])->name('change.password');
    Route::post('/ubah-kontak-pribadi', [MahasiswaController::class, 'ubahKontakPribadi'])->name('ubah.kontak.pribadi');
    Route::post('/ubah-kontak-darurat', [MahasiswaController::class, 'ubahKontakDarurat'])->name('ubah.kontak.darurat');

});

// Dosen Routes List
Route::middleware(['auth', 'user-access:dosen'])->group(function () {

    Route::get('/dosen/dashboard', [HomeController::class, 'dosenHome'])->name('dosen.home');

    Route::get('/dosen/agenda', [DosenController::class, 'agenda'])->name('dosen.agenda');
    Route::get('/dosen/agenda/show/{id}', [DosenController::class, 'showAgenda'])->name('dosen.agenda.show');
    Route::put('/dosen/agenda/update/{id}', [DosenController::class, 'updateAgenda'])->name('dosen.agenda.update');

    Route::get('/dosen/aktivitas', [DosenController::class, 'aktivitas'])->name('dosen.aktivitas');
    Route::get('/dosen/aktivitas/show/{id}', [DosenController::class, 'showAktivitas'])->name('dosen.aktivitas.show');

    Route::get('/dosen/mandiri', [DosenController::class, 'mandiri'])->name('dosen.mandiri');
    Route::get('/dosen/mandiri/show/{id}', [DosenController::class, 'showMandiri'])->name('dosen.mandiri.show');

    Route::get('/dosen/prestasi', [DosenController::class, 'prestasi'])->name('dosen.prestasi');
    Route::get('/dosen/prestasi/show/{id}', [DosenController::class, 'showPrestasi'])->name('dosen.prestasi.show');

    Route::get('/dosen/ormawa', [DosenController::class, 'ormawa'])->name('dosen.ormawa');
    Route::get('/dosen/ormawa/show/{id}', [DosenController::class, 'showOrmawa'])->name('dosen.ormawa.show');

    Route::get('/dosen/mahasiswa', [DosenController::class, 'listMahasiswa'])->name('dosen.mahasiswa');
    Route::get('/dosen/mahasiswa/{id}', [DosenController::class, 'showMhs'])->name('dosen.show.mahasiswa');

    Route::get('/dosen/profile', [DosenController::class, 'profile'])->name('dosen.profile');
    Route::post('/dosen/change-password', [DosenController::class, 'changePassword'])->name('dosen.change.password');
    Route::post('/dosen/change-contact', [DosenController::class, 'changeContact'])->name('dosen.contact.update');

});

// Admin Route List
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/dashboard', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::get('/admin/agenda', [AgendaController::class, 'index'])->name('admin.agenda');
    Route::post('/admin/agenda/store', [AgendaController::class, 'store'])->name('admin.agenda.store');
    Route::get('/admin/agenda/edit/{id}', [AgendaController::class, 'edit'])->name('admin.agenda.edit');
    Route::put('/admin/agenda/update/{id}', [AgendaController::class, 'update'])->name('admin.agenda.update');
    Route::delete('/admin/agenda/delete/{id}', [AgendaController::class, 'destroy'])->name('admin.agenda.delete');

    Route::get('/admin/kegiatan', [KegiatanController::class, 'index'])->name('admin.kegiatan');
    Route::post('/admin/kegiatan/store', [KegiatanController::class, 'store'])->name('admin.kegiatan.store');
    Route::get('/admin/kegiatan/edit/{id}', [KegiatanController::class, 'edit'])->name('admin.kegiatan.edit');
    Route::put('/admin/kegiatan/update/{id}', [KegiatanController::class, 'update'])->name('admin.kegiatan.update');
    Route::delete('/admin/kegiatan/delete/{id}', [KegiatanController::class, 'destroy'])->name('admin.kegiatan.delete');

    Route::get('/admin/ormawa', [OrmawaController::class, 'index'])->name('admin.ormawa');
    Route::post('/admin/ormawa/store', [OrmawaController::class, 'store'])->name('admin.ormawa.store');
    Route::get('/admin/ormawa/edit/{id}', [OrmawaController::class, 'edit'])->name('admin.ormawa.edit');
    Route::put('/admin/ormawa/update/{id}', [OrmawaController::class, 'update'])->name('admin.ormawa.update');
    Route::delete('/admin/ormawa/delete/{id}', [OrmawaController::class, 'destroy'])->name('admin.ormawa.delete');

    Route::get('/admin/jenjang', [JenjangController::class, 'index'])->name('admin.jenjang');
    Route::post('/admin/jenjang/store', [JenjangController::class, 'store'])->name('admin.jenjang.store');
    Route::get('/admin/jenjang/edit/{id}', [JenjangController::class, 'edit'])->name('admin.jenjang.edit');
    Route::put('/admin/jenjang/update/{id}', [JenjangController::class, 'update'])->name('admin.jenjang.update');
    Route::delete('/admin/jenjang/delete/{id}', [JenjangController::class, 'destroy'])->name('admin.jenjang.delete');

    Route::get('/admin/jalur-masuk', [JalurController::class, 'index'])->name('admin.jalur-masuk');
    Route::post('/admin/jalur/store', [JalurController::class, 'store'])->name('admin.jalur.store');
    Route::get('/admin/jalur/edit/{id}', [JalurController::class, 'edit'])->name('admin.jalur.edit');
    Route::put('/admin/jalur/update/{id}', [JalurController::class, 'update'])->name('admin.jalur.update');
    Route::delete('/admin/jalur/delete/{id}', [JalurController::class, 'destroy'])->name('admin.jalur.delete');

    Route::get('/admin/prodi', [ProdiController::class, 'index'])->name('admin.prodi');
    Route::post('/admin/prodi/store', [ProdiController::class, 'store'])->name('admin.prodi.store');
    Route::get('/admin/prodi/edit/{id}', [ProdiController::class, 'edit'])->name('admin.prodi.edit');
    Route::put('/admin/prodi/update/{id}', [ProdiController::class, 'update'])->name('admin.prodi.update');
    Route::delete('/admin/prodi/delete/{id}', [ProdiController::class, 'destroy'])->name('admin.prodi.delete');

    Route::get('/admin/fakultas', [FakultasController::class, 'index'])->name('admin.fakultas');
    Route::post('/admin/fakultas/store', [FakultasController::class, 'store'])->name('admin.fakultas.store');
    Route::get('/admin/fakultas/edit/{id}', [FakultasController::class, 'edit'])->name('admin.fakultas.edit');
    Route::put('/admin/fakultas/update/{id}', [FakultasController::class, 'update'])->name('admin.fakultas.update');
    Route::delete('/admin/fakultas/delete/{id}', [FakultasController::class, 'destroy'])->name('admin.fakultas.delete');

    Route::get('/admin/member', [AdminController::class, 'index'])->name('admin.member');
    Route::post('/admin/member/store', [AdminController::class, 'store'])->name('admin.member.store');
    Route::delete('/admin/member/delete/{id}', [AdminController::class, 'destroy'])->name('admin.member.delete');

    Route::get('/admin/mahasiswa', [AdminController::class, 'mahasiswa'])->name('admin.mahasiswa');
    Route::get('/admin/mahasiswa/export', [AdminController::class, 'mahasiswaExport'])->name('admin.mahasiswa.export');
    Route::post('/admin/mahasiswa/import', [AdminController::class, 'mahasiswaImport'])->name('admin.mahasiswa.import');
    Route::get('/admin/mahasiswa/generate', [AdminController::class, 'generateMhs'])->name('admin.mahasiswa.generate');

    Route::get('/admin/dosen', [AdminController::class, 'dosen'])->name('admin.dosen');
    Route::get('/admin/dosen/export', [AdminController::class, 'dosenExport'])->name('admin.dosen.export');
    Route::post('/admin/dosen/import', [AdminController::class, 'dosenImport'])->name('admin.dosen.import');
    Route::get('/admin/dosen/generate', [AdminController::class, 'generateDosen'])->name('admin.dosen.generate');

    Route::post('/admin/user/reset-password/{id}', [AdminController::class, 'resetPassword'])->name('admin.reset.password');
});
