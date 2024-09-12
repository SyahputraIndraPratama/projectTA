<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use App\Models\Pegawai;
use App\Models\SettingsGaji;
use Illuminate\Http\Request;

class PayrollHRDController extends Controller
{
    public function home(Request $request)
    {
        $pages = 'pegawai';
        $month = date("m");
        $year = date("Y");
        $cari = $request->cari;

        if ($cari) {
            $month = date("m", strtotime($cari));
            $year = date("Y", strtotime($cari));
        }

        $datas = Payroll::whereMonth('tgl_payroll', $month)
            ->whereYear('tgl_payroll', $year)
            ->get();

        $getsettingsgaji = SettingsGaji::first();

        return view('hrd.gaji', compact('datas', 'request', 'pages', 'cari'));
    }
}
