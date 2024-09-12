<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::all();
        return view('admin.perusahaan.jabatan', ['data' => $jabatan]);
    }

    public function edit($id)
    {
        $jabatan = Provinsi::find($id);
        return response()->json($jabatan);
    }

    public function update(Request $request, $id_jabatan)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'required|numeric',
        ]);

        $jabatan = Jabatan::find($id_jabatan);
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->gaji_pokok = $request->gaji_pokok;
        $jabatan->tunjangan = $request->tunjangan;
        $jabatan->save();
        Alert::success('Success', 'Data Berhasil diupdate', '1500');
        return to_route('jabatan.index');
    }

    public function destroy($id_jabatan)
    {
        $jabatan = Jabatan::find($id_jabatan);
        if ($jabatan) {
            $jabatan->delete();
            Alert::success('Success', 'Data Berhasil dihapus', '1500');
            return redirect()->route('jabatan.index');
        } else {
            Alert::error('Error', 'Data Tidak Dapat dihapus', '1500');
            return redirect()->route('jabatan.index');
        }
    }
}
