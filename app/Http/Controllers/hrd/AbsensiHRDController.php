<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiHRDController extends Controller
{
    public function index()
    {
        $data = Absensi::all(); // Ambil semua data absensi
        $totalMasuk = Absensi::where('keterangan', 'masuk')->count();
        $totalKeluar = Absensi::where('keterangan', 'keluar')->count();

        return view('hrd.absensi_pegawai', compact('data', 'totalMasuk', 'totalKeluar'));
    }
}
