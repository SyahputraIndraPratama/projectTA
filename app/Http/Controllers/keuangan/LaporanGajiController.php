<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class LaporanGajiController extends Controller
{
    public function home()
    {
        $pegawai = Pegawai::with('jabatan')->get();
        // Mengambil data payroll dari database
        $payroll = Payroll::with('pegawai.jabatan')->get();

        // Mengirim data ke view
        return view('keuangan.laporan.gaji', compact('pegawai', 'payroll'));
    }

    public function print()
    {
        // Ambil data untuk laporan
        $pegawai = Pegawai::with('jabatan')->get();
        // Mengambil data payroll dari database
        $payroll = Payroll::with(['pegawai.jabatan'])->get();

        // Cetak laporan atau arahkan ke halaman cetak laporan
        return view('keuangan.laporan.laporan_gaji_all', compact('pegawai', 'payroll'));
    }
}
