<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Request\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeKeuanganController extends Controller
{
    public function index()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $totalPendaftar = DB::table('job_applications')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        $totalPegawai = DB::table('pegawai')->count();
        $jumlahJabatan = DB::table('jabatan')->count();
        $jumlahBagian = DB::table('bagian')->count();

        $pegawai = DB::table('pegawai')
            ->join('jabatan', 'pegawai.id_jabatan', '=', 'jabatan.id_jabatan')
            ->join('bagian', 'pegawai.id_bagian', '=', 'bagian.id_bagian')
            ->select('pegawai.nama', 'jabatan.nama_jabatan as nama_jabatan', 'bagian.nama_bagian as nama_bagian', 'pegawai.tgl_lahir', 'pegawai.tgl_masuk')
            ->get();

        return view('keuangan.dashboard.home', compact('totalPendaftar', 'totalPegawai', 'jumlahJabatan', 'jumlahBagian', 'pegawai'));
    }
}
