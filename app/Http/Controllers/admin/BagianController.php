<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BagianController extends Controller
{
    public function index()
    {
        $bagian = Bagian::all();
        return view('admin.perusahaan.bagian', ['data' => $bagian]);
    }

    public function tambah(Request $request)
    {
        $data = [
            'nama_bagian' => $request->bagian,
        ];

        Bagian::create($data);
        Alert::success('Success', 'Data Berhasil ditambahkan', '1500');
        return to_route('bagian.index');
    }

    public function edit($id)
    {
        $bagian = Bagian::find($id);
        return response()->json($bagian);
    }

    public function update(Request $request, $id_bagian)
    {
        $request->validate([
            'nama_bagian' => 'required|string|max:255',
        ]);

        $bagian = Bagian::find($id_bagian);
        $bagian->bagian = $request->bagian;
        $bagian->save();
        Alert::success('Success', 'Data Berhasil diupdate', '1500');
        return to_route('bagian.index');
    }

    public function destroy($id_bagian)
    {
        $bagian = Bagian::find($id_bagian);
        if ($bagian) {
            $bagian->delete();
            Alert::success('Success', 'Bagian Pegawai Berhasil dihapus', '1500');
            return redirect()->route('bagian.index');
        } else {
            Alert::error('Error', 'Bagian Pegawai Tidak Dapat dihapus', '1500');
            return redirect()->route('bagian.index');
        }
    }
}
