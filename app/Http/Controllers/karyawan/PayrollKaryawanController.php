<?php

namespace App\Http\Controllers\karyawan;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use App\Models\SettingsGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayrollKaryawanController extends Controller
{
    public function index(Request $request)
    {
        $pages = 'pegawai';
        $month = date("m");
        $year = date("Y");
        $cari = $request->cari;

        if ($cari) {
            $month = date("m", strtotime($cari));
            $year = date("Y", strtotime($cari));
        }

        // Mendapatkan id_pegawai dari pengguna yang sedang login
        $id_pegawai = Auth::user()->pegawai->id_pegawai;

        // Mengambil data payroll berdasarkan bulan, tahun, dan id_pegawai
        $datas = Payroll::whereMonth('tgl_payroll', $month)
            ->whereYear('tgl_payroll', $year)
            ->where('id_pegawai', $id_pegawai)
            ->get();

        $getsettingsgaji = SettingsGaji::first();

        return view('karyawan.payroll', compact('datas', 'request', 'pages', 'cari'));
    }


    public function showSlip($id)
    {
        $payment = Payroll::findOrFail($id);

        // Logika untuk menampilkan slip pembayaran

        return view('hrd.show_slip', compact('payment'));
    }
}
