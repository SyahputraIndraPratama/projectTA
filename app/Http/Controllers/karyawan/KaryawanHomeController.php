<?php

namespace App\Http\Controllers\karyawan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class KaryawanHomeController extends Controller
{
    public function index(Request $request)
    {
        return view('karyawan.dashboard.home');
    }
    
    public function prosesAbsen(Request $request)
    {
        $user = auth()->user();
        $pegawai = Pegawai::where('id_pegawai', $user->id_pegawai)->first();

        if (!$pegawai) {
            return redirect()->route('karyawan.absen')->with('error', 'Pegawai tidak ditemukan');
        }

        $request->validate([
            'ket' => 'required',
            'by' => 'required|date',
        ]);

        // Save to database
        Absensi::create([
            'id_pegawai' => $pegawai->id_pegawai, // Use the correct field name
            'nip' => $pegawai->nip,
            'keterangan' => $request->input('ket'),
            'waktu' => now(),
            'estimated' => $request->input('by'),
        ]);

        $message = $request->input('ket') == 'masuk' ? 'Berhasil absen masuk' : 'Berhasil absen keluar';
        Alert::success('Success', $message, '1500');
        return to_route('karyawan.absen');
    }
}
