<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class LihatPegawaiController extends Controller
{
    public function index()
    {
        $data = Pegawai::with('jabatan')->get(); // Load data pegawai beserta data jabatan
        return view('hrd.pegawai', compact('data'));
    }

    public function detail($id)
    {
        // Fetch employee details with related models
        $pegawai = Pegawai::with(['jabatan', 'bagian', 'kecamatan', 'kabupaten', 'provinsi'])->find($id);

        // Fetch all payroll details
        $pay = Payroll::all();

        // Calculate additional fields for payroll
        foreach ($pay as $p) {
            $p->alfa = $p->gaji_pokok / 26 * $p->alpha;
            $bruto_setahun = $p->gaji_pokok + $p->tunjangan * 12;
            $jabatan = 0.05 * $bruto_setahun;
            $netto = $bruto_setahun - $jabatan;
            $pkp = 54000000 - $netto;
            $lapis_pertama = 0.05 * 50000000;
            $p->pph = $lapis_pertama / 12;
            $p->total = $p->pegawai->jabatan->gaji_pokok + $p->pegawai->jabatan->tunjangan - $p->bpjs - $p->tunjangan;
        }

        // Return the view with employee and payroll data
        return view('hrd.detail_pegawai', compact('pegawai', 'pay'));
    }
}
