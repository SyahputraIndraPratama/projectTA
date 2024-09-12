<?php

use App\Http\Controllers\admin\AbsensiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\frontend\FormController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\JabatanController;
use App\Http\Controllers\admin\KabupatenController;
use App\Http\Controllers\admin\KecamatanController;
use App\Http\Controllers\admin\ProvinsiController;
use App\Http\Controllers\admin\TambahBagianController;
use App\Http\Controllers\admin\TambahJabatanController;
use App\Http\Controllers\admin\BagianController;
use App\Http\Controllers\admin\LoginAdminController;
use App\Http\Controllers\admin\PegawaiController;
use App\Http\Controllers\admin\TambahPegawaiController;
use App\Http\Controllers\auth\ProfileController as AuthProfileController;
use App\Http\Controllers\auth\VerificationController;
use App\Http\Controllers\frontend\HistoryController;
use App\Http\Controllers\frontend\ProfileController;
use App\Http\Controllers\frontend\SuccessController;
use App\Http\Controllers\hrd\AbsensiHRDController;
use App\Http\Controllers\hrd\ApplyController;
use App\Http\Controllers\hrd\HomeHRDController;
use App\Http\Controllers\hrd\InterviewController;
use App\Http\Controllers\hrd\JobController;
use App\Http\Controllers\hrd\LihatPegawaiController;
use App\Http\Controllers\hrd\LoginHRDController;
use App\Http\Controllers\hrd\PayrollHRDController;
use App\Http\Controllers\karyawan\AbsensiKaryawanController;
use App\Http\Controllers\karyawan\KaryawanHomeController;
use App\Http\Controllers\karyawan\LoginKaryawanController;
use App\Http\Controllers\karyawan\PayrollKaryawanController;
use App\Http\Controllers\keuangan\HomeKeuanganController;
use App\Http\Controllers\keuangan\LaporanGajiController;
use App\Http\Controllers\keuangan\LoginKeuanganController;
use App\Http\Controllers\keuangan\PayrollController;
use App\Http\Controllers\keuangan\SettingGajiController;
use App\Models\Payroll;

Route::get('/', [App\Http\Controllers\frontend\HomePageController::class, 'index']);
Route::get('/lowongan', [App\Http\Controllers\frontend\LowonganController::class, 'index']);
Route::get('/detail/{identifier}', [App\Http\Controllers\frontend\DetailController::class, 'home'])->name('detail');
//Route::get('/detail/{jobname}', [App\Http\Controllers\frontend\LowonganController::class, 'showJobDetails'])->name('job.details');
Route::middleware(['auth'])->group(function () {
    Route::get('/history', [HistoryController::class, 'showHistori'])->name('applications.index');
    Route::post('/history/interview/{jobname}', [HistoryController::class, 'interview'])->name('applications.interview');
    Route::post('/history/verify/{id}', [HistoryController::class, 'verify'])->name('applications.verify');
    Route::post('/history/accept/{id}', [HistoryController::class, 'accept'])->name('applications.accept');
    Route::post('/history/reject/{id}', [HistoryController::class, 'reject'])->name('applications.reject');
});

//Auth::routes(['verify' => true]);
//Route::get('/verify-email', [VerificationController::class, 'index'])->name('verify-otp');
//Route::get('/send-otp', [VerificationController::class, 'send_otp'])->name('send-otp');


//Route::get('/', function () {
//    return view('welcome');
//});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/form_apply/{identifier}', [FormController::class, 'home'])->name('formjob.index');
Route::post('/form_apply/{identifier}', [FormController::class, 'apply'])->name('job.apply');

Route::get('/job-thank-you', [SuccessController::class, 'index']);
Route::get('/profile', [ProfileController::class, 'index']);

Route::prefix('admin')->group(function () {
    // Provinsi routes
    Route::get('/provinsi', [ProvinsiController::class, 'index'])->name('provinsi.index');
    Route::post('/provinsi/tambah', [ProvinsiController::class, 'tambah'])->name('provinsi.tambah');
    Route::get('/provinsi/edit/{id}', [ProvinsiController::class, 'edit'])->name('provinsi.edit');
    Route::put('/provinsi/update/{id}', [ProvinsiController::class, 'update'])->name('provinsi.update');
    Route::delete('/provinsi/hapus/{id}', [ProvinsiController::class, 'destroy'])->name('provinsi.hapus');

    // Kabupaten routes
    Route::get('/kabupaten', [KabupatenController::class, 'index'])->name('kabupaten.index');
    Route::post('/kabupaten/tambah', [KabupatenController::class, 'tambah'])->name('kabupaten.tambah');
    Route::get('/kabupaten/edit/{id}', [KabupatenController::class, 'edit'])->name('kabupaten.edit');
    Route::put('/kabupaten/update/{id}', [KabupatenController::class, 'update'])->name('kabupaten.update');
    Route::delete('/kabupaten/hapus/{id}', [KabupatenController::class, 'destroy'])->name('kabupaten.hapus');

    // Kecamatan routes
    Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan.index');
    Route::post('/kecamatan/tambah', [KecamatanController::class, 'tambah'])->name('kecamatan.tambah');
    Route::get('/kecamatan/edit/{id}', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
    Route::put('/kecamatan/update/{id}', [KecamatanController::class, 'update'])->name('kecamatan.update');
    Route::delete('/kecamatan/hapus/{id}', [KecamatanController::class, 'destroy'])->name('kecamatan.hapus');

    // Jabatan routes
    Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
    Route::get('/jabatan/edit/{id}', [JabatanController::class, 'edit'])->name('jabatan.edit');
    Route::put('/jabatan/update/{id}', [JabatanController::class, 'update'])->name('jabatan.update');
    Route::delete('/jabatan/hapus/{id}', [JabatanController::class, 'destroy'])->name('jabatan.hapus');

    // Tambah Jabatan routes
    Route::get('/jabatan/tambah_jabatan', [TambahJabatanController::class, 'index']);
    Route::post('/jabatan/tambah_jabatan/tambah', [TambahJabatanController::class, 'tambah'])->name('tambah');

    // Bagian routes
    Route::get('/bagian', [BagianController::class, 'index'])->name('bagian.index');
    Route::get('/bagian/tambah', [TambahBagianController::class, 'index'])->name('tambah.bagian');
    Route::post('/bagian/tambah', [BagianController::class, 'tambah'])->name('bagian.tambah');
    Route::get('/bagian/edit/{id}', [BagianController::class, 'edit'])->name('bagian.edit');
    Route::put('/bagian/update/{id}', [BagianController::class, 'update'])->name('bagian.update');
    Route::delete('/bagian/hapus/{id}', [BagianController::class, 'destroy'])->name('bagian.hapus');

    // Pegawai routes
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/tambah', [TambahPegawaiController::class, 'index'])->name('pegawai.tambah');
    Route::get('/pegawai/get-gajitunjangan', [TambahPegawaiController::class, 'getGajiTunjangan'])->name('pegawai.getgajitunjangan');
    Route::post('/pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::get('/pegawai/detail/{id}', [PegawaiController::class, 'detail'])->name('detail.edit');
    Route::put('/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/hapus/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.hapus');
    Route::get('/pegawai/cetak/', [PegawaiController::class, 'cetakPegawai'])->name('pegawai.cetak');

    // Absensi routes
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
});

Route::prefix('karyawan')->group(function () {
    // Login route
    Route::get('/login', [LoginKaryawanController::class, 'index'])->name('login.karyawan');
    Route::post('/login', [LoginKaryawanController::class, 'login'])->name('karyawan.login');
    Route::post('/logout', [LoginKaryawanController::class, 'logout'])->name('karyawan.logout');

    // karyawan route
    Route::get('/dashboard', [KaryawanHomeController::class, 'index'])->name('karyawan.dashboard');
    Route::post('/dashboard/proses-absen', [KaryawanHomeController::class, 'prosesAbsen'])->name('karyawan.proses_absen');

    Route::get('/absensi', [AbsensiKaryawanController::class, 'index'])->name('karyawan.absen.index');

    // payroll karyawan
    Route::get('/payroll', [PayrollKaryawanController::class, 'index'])->name('karyawan.payroll.index');
});

Route::prefix('hrd')->group(function () {
    // hrd login
    Route::get('/login', [LoginHRDController::class, 'index']);
    Route::post('/login', [LoginHRDController::class, 'login'])->name('hrd.login');
    Route::post('/logout', [LoginHRDController::class, 'logout'])->name('hrd.logout');

    // hrd home
    Route::get('/home', [HomeHRDController::class, 'index'])->name('hrd.index');

    // // hrd lamaran masuk
    // Route::get('/jobapply', [ApplyController::class, 'index'])->name('hrd.apply.index');
    // Route::get('/jobapply/{id}/view-resume', [ApplyController::class, 'viewResume'])->name('hrd.apply.viewResume');
    // Route::get('/interview', [InterviewController::class, 'index'])->name('schedule.index');
    // Route::post('/interview/schedule/{id}', [ApplyController::class, 'jadwal'])->name('interview.schedule');
    // Route::delete('/jobapply/{id}', [ApplyController::class, 'destroy'])->name('hrd.apply.destroy');

    // hrd melihat data karyawan
    Route::get('/pegawai', [LihatPegawaiController::class, 'index'])->name('hrd.pegawai');
    Route::get('/pegawai/detail/{id}', [LihatPegawaiController::class, 'detail'])->name('hrd.pegawai.detail');

    // melihat Absensi Pegawai
    Route::get('/absensi', [AbsensiHRDController::class, 'index'])->name('hrd.absensi.pegawai');

    // hrd kelola job
    Route::get('/kelola_job', [JobController::class, 'index'])->name('jobs.index');
    // Route::get('/kelola_job/lamaran_masuk', [ApplyController::class, 'index'])->name('hrd.apply.index');
    Route::get('/kelola_job/lamaran_masuk', [ApplyController::class, 'show'])->name('jobs.show');
    Route::get('/kelola_job/{id}/view-resume', [ApplyController::class, 'viewResume'])->name('hrd.apply.viewResume');
    Route::get('/kelola_job/interview', [InterviewController::class, 'index'])->name('schedule.index');
    Route::post('/kelola_job/interview/schedule/{id}', [ApplyController::class, 'jadwal'])->name('interview.schedule');
    Route::delete('/jobapply/{id}', [ApplyController::class, 'destroy'])->name('hrd.apply.destroy');
    Route::get('/kelola_job/create', [JobController::class, 'create'])->name('jobs.tambah');
    Route::post('/kelola_job', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/kelola_job/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/kelola_job/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/kelola_job/{job}', [JobController::class, 'destroy'])->name('jobs.hapus');

    // hrd payroll
    Route::get('/payroll', [PayrollHRDController::class, 'home'])->name('hrd.payroll');
});

Route::prefix('keuangan')->group(function () {
    // Login
    Route::get('/login', [LoginKeuanganController::class, 'index']);
    Route::post('/login', [LoginKeuanganController::class, 'login']);
    Route::post('/logout', [LoginKeuanganController::class, 'logout']);
    
    Route::get('/home', [HomeKeuanganController::class, 'index']);

    // Setting Gaji routes
    Route::get('/settingsgaji', [SettingGajiController::class, 'index'])->name('settingsgaji.index');
    Route::post('/settingsgaji', [SettingGajiController::class, 'store'])->name('settingsgaji.store');

    // Payroll routes
    Route::get('/payroll', [PayrollController::class, 'home'])->name('payroll.index');
    Route::post('/payroll/generate', [PayrollController::class, 'generate'])->name('payroll.generate');
    Route::delete('/payroll/delete/{id}', [PayrollController::class, 'delete'])->name('payroll.delete');
    Route::get('/payroll/tambah', [PayrollController::class, 'tambah'])->name('payroll.tambah');
    Route::get('/payroll/get-pegawai', [PayrollController::class, 'getPegawai'])->name('payroll.get-pegawai');
    Route::get('/payroll/get-jabatan', [PayrollController::class, 'getJabatan'])->name('payroll.get-jabatan');
    Route::post('/payroll/simpan', [PayrollController::class, 'simpan'])->name('payroll.simpan');
    //Route::get('/payroll/slip/cetak', [PayrollController::class, 'cetak'])->name('payroll.slip');
    Route::get('/payroll/slip/cetakperid/{id}', [PayrollController::class, 'cetak'])->name('payroll.slip.perid');
    Route::get('/payroll/slip/cetakrincian', [PayrollController::class, 'cetakrincian'])->name('payroll.slip.rincian');
    Route::post('/payroll/slip/send/{id}', [PayrollController::class, 'send'])->name('payroll.send');

    // Laporan routes
    Route::get('/laporan_gaji', [LaporanGajiController::class, 'home'])->name('laporan_gaji.index');
    Route::get('/laporan_gaji/print', [LaporanGajiController::class, 'print'])->name('laporan_gaji.print');
});


Route::get('/admin/login', [LoginAdminController::class, 'index']);
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [LoginAdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/home', [HomeController::class, 'index']);

Route::get('/verif', [RegisterController::class, 'showViewOtp'])->name('showOtp');
Route::post('/verif', [RegisterController::class, 'verifyOtp'])->name('otp.verify');

//Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
