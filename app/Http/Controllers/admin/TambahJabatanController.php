<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TambahJabatanController extends Controller
{
    public function index()
    {
        $tambahjabatan = Jabatan::all();
        return view('admin.perusahaan.tambah_jabatan', ['data' => $tambahjabatan]);
    }

    public function tambah(Request $request)
    {
        $data = [
            'nama_jabatan' => $request->nama_jabatan,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan,
            'benefit1' => $request->benefit1,
            'benefit2' => $request->benefit2,
            'benefit3' => $request->benefit3,
        ];

        Jabatan::create($data);
        Alert::success('Success', 'Data Berhasil ditambahkan', '1500');
        return to_route('jabatan.index');
    }
}
