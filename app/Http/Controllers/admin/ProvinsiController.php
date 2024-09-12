<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use RealRashid\SweetAlert\Facades\Alert;

class ProvinsiController extends Controller
{
    public function index()
    {
        $provinsi = Provinsi::all();
        return view('admin.provinsi', ['data' => $provinsi]);
    }

    public function tambah(Request $request)
    {
        $data = [
            'provinsi' => $request->provinsi,
        ];

        Provinsi::create($data);
        Alert::success('Success', 'Data Berhasil ditambahkan', '1500');
        return to_route('provinsi.index');
    }

    public function edit($id)
    {
        $pegawais = Provinsi::find($id);
        return response()->json($pegawais);
    }

    public function update(Request $request, $id_provinsi)
    {
        $request->validate([
            'provinsi' => 'required|string|max:255',
        ]);

        $provinsi = Provinsi::find($id_provinsi);
        $provinsi->provinsi = $request->provinsi;
        $provinsi->save();
        Alert::success('Success', 'Data Berhasil diupdate', '1500');
        return to_route('provinsi.index');
    }

    public function destroy($id_provinsi)
    {
        $provinsi = Provinsi::find($id_provinsi);
        if ($provinsi) {
            $provinsi->delete();
            Alert::success('Success', 'Provinsi Berhasil dihapus', '1500');
            return redirect()->route('provinsi.index');
        } else {
            Alert::error('Error', 'Provinsi Tidak Dapat dihapus', '1500');
            return redirect()->route('provinsi.index');
        }
    }
}
