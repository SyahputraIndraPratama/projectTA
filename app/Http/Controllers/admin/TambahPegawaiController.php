<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Jabatan;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Pegawai;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class TambahPegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
        $prov = Provinsi::all();
        $kab = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        $jabatan = Jabatan::all();
        $bagian = Bagian::all();
        return view('admin.tambah_pegawai', compact('pegawais', 'prov', 'kab', 'kecamatan', 'jabatan', 'bagian'));
    }

    public function getGajiTunjangan(Request $request)
    {
        $id_jabatan = $request->input('id_jabatan');
        $jabatan = Jabatan::with('pegawai')->find($id_jabatan);

        if ($jabatan) {
            return response()->json([
                'gaji_pokok' => $jabatan->gaji_pokok,
                'tunjangan' => $jabatan->tunjangan,
            ]);
        }

        return response()->json();
    }
}
