<?php

use App\Http\Controllers\adminabsensicontroller;
use App\Http\Controllers\admindashboardcontroller;
use App\Http\Controllers\adminkelascontroller;
use App\Http\Controllers\adminsiswacontroller;
use App\Http\Controllers\admintapelcontroller;
use App\Http\Controllers\adminuserscontroller;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});


//halaman admin fixed
Route::group(['middleware' => ['auth:web', 'verified']], function () {

    //DASHBOARD-MENU
    Route::get('/dashboard', [admindashboardcontroller::class, 'index'])->name('dashboard');

    //MASTERING
    //USER
    Route::get('/admin/users', [adminuserscontroller::class, 'index'])->name('users');
    Route::get('/admin/users/profile/{id}', [adminuserscontroller::class, 'profile'])->name('users.profile');
    Route::get('/admin/users/{id}', [adminuserscontroller::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{id}', [adminuserscontroller::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{id}', [adminuserscontroller::class, 'destroy'])->name('users.destroy');
    Route::get('/admin/users/datausers/cari', [adminuserscontroller::class, 'cari'])->name('users.cari');
    Route::get('/admin/users/datausers/create', [adminuserscontroller::class, 'create'])->name('users.create');
    Route::post('/admin/users/datausers', [adminuserscontroller::class, 'store'])->name('users.store');
    Route::delete('/admin/users/datausers/multidel', [adminuserscontroller::class, 'multidel'])->name('users.multidel');

    //tapel
    Route::get('/admin/tapel', [admintapelcontroller::class, 'index'])->name('tapel');
    Route::get('/admin/tapel/{id}', [admintapelcontroller::class, 'edit'])->name('tapel.edit');
    Route::put('/admin/tapel/{id}', [admintapelcontroller::class, 'update'])->name('tapel.update');
    Route::delete('/admin/tapel/{id}', [admintapelcontroller::class, 'destroy'])->name('tapel.destroy');
    Route::get('/admin/tapel/cari', [admintapelcontroller::class, 'cari'])->name('tapel.cari');
    Route::get('/admin/tapel/datatapel/create', [admintapelcontroller::class, 'create'])->name('tapel.create');
    Route::post('/admin/tapel/datatapel', [admintapelcontroller::class, 'store'])->name('tapel.store');
    Route::delete('/admin/tapel/multidel', [admintapelcontroller::class, 'multidel'])->name('tapel.multidel');

    //kelas
    Route::get('/admin/kelas', [adminkelascontroller::class, 'index'])->name('kelas');
    Route::get('/admin/kelas/{id}', [adminkelascontroller::class, 'edit'])->name('kelas.edit');
    Route::put('/admin/kelas/{id}', [adminkelascontroller::class, 'update'])->name('kelas.update');
    Route::delete('/admin/kelas/{id}', [adminkelascontroller::class, 'destroy'])->name('kelas.destroy');
    Route::get('/admin/kelas/datakelas/cari', [adminkelascontroller::class, 'cari'])->name('kelas.cari');
    Route::get('/admin/kelas/datakelas/create', [adminkelascontroller::class, 'create'])->name('kelas.create');
    Route::post('/admin/kelas/datakelas', [adminkelascontroller::class, 'store'])->name('kelas.store');
    Route::delete('/admin/kelas/datakelas/multidel', [adminkelascontroller::class, 'multidel'])->name('kelas.multidel');

    //siswa
    Route::get('/admin/siswa', [adminsiswacontroller::class, 'index'])->name('siswa');
    Route::get('/admin/siswa/{id}', [adminsiswacontroller::class, 'edit'])->name('siswa.edit');
    Route::post('/admin/siswa/{id}/reset', [adminsiswacontroller::class, 'reset'])->name('siswa.reset');
    Route::put('/admin/siswa/{id}', [adminsiswacontroller::class, 'update'])->name('siswa.update');
    Route::delete('/admin/siswa/{id}', [adminsiswacontroller::class, 'destroy'])->name('siswa.destroy');
    Route::get('/admin/siswa/datasiswa/cari', [adminsiswacontroller::class, 'cari'])->name('siswa.cari');
    Route::get('/admin/siswa/datasiswa/create', [adminsiswacontroller::class, 'create'])->name('siswa.create');
    Route::post('/admin/siswa/datasiswa', [adminsiswacontroller::class, 'store'])->name('siswa.store');
    Route::delete('/admin/siswa/datasiswa/multidel', [adminsiswacontroller::class, 'multidel'])->name('siswa.multidel');
    Route::get('/admin/siswa/datasiswa/cetakPDF', [adminsiswacontroller::class, 'cetakPDF'])->name('siswa.cetakPDF');
    Route::get('/admin/siswa/datasiswa/cariPDF', [adminsiswacontroller::class, 'cariPDF'])->name('siswa.cariPDF');
    Route::post('/admin/siswa/datasiswa/cetakPDF/{tapel}/{kelas}', [adminsiswacontroller::class, 'cetakKelasPDF'])->name('siswa.cetakKelasPDF');

    //absensi
    Route::get('/admin/absensi', [adminabsensicontroller::class, 'index'])->name('absensi');
    Route::get('/admin/absensi/tahunAjaran/cari', [adminabsensicontroller::class, 'cariTapel'])->name('absensi.cariTapel');
    Route::get('/admin/absensi/dataabsensi/cari', [adminabsensicontroller::class, 'cari'])->name('absensi.cari');
    Route::get('/admin/absensi/detail/{tapel}/{kelas}', [adminabsensicontroller::class, 'detail'])->name('absensi.detail');
    Route::get('/admin/absensi/detailAbsen/{kelas}', [adminabsensicontroller::class, 'detailAbsen'])->name('absensi.detailAbsen');
    Route::post('/admin/absensi/detail/{kelas}/store', [adminabsensicontroller::class, 'store'])->name('absensi.store');
    Route::post('/admin/absensi/detail/store/{tapel}/{kelas}', [adminabsensicontroller::class, 'storev2'])->name('absensi.storev2');
    Route::delete('/admin/absensi/dataabsensi/{kelas}/data/{id}', [adminabsensicontroller::class, 'destroy'])->name('absensi.delete');

    Route::get('/admin/laporan', [adminabsensicontroller::class, 'laporan'])->name('laporan');
    Route::get('/admin/laporan/tanggalLaporan/cari/{tahun}/{kelas}', [adminabsensicontroller::class, 'cariTanggal'])->name('laporan.cariTanggal');
    Route::get('/admin/laporan/dataSiswa/cari', [adminabsensicontroller::class, 'cariSiswa'])->name('laporan.cariSiswa');
    Route::get('/admin/laporan/detail/{tahun}/{kelas}', [adminabsensicontroller::class, 'laporanDetail'])->name('laporan.detail');
    Route::get('/admin/laporan/detail/show/{tahun}/{kelas}/{tgl}', [adminabsensicontroller::class, 'laporanShow'])->name('laporan.detailAbsen');
    Route::delete('/admin/laporan/{dataa}/{data}', [adminabsensicontroller::class, 'destroyAbsen'])->name('laporan.delete');
    Route::post('/admin/laporan/cetak/{tahun}/{kelas}/{tgl}', [adminabsensicontroller::class, 'cetakPDF'])->name('laporan.cetakPDF');
});
