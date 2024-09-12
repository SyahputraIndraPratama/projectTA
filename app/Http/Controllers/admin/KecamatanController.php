<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use RealRashid\SweetAlert\Facades\Alert;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatan = Kecamatan::with('kabupaten')->get();
        $kabupaten = Kabupaten::all();
        return view('admin.kecamatan', ['data' => $kecamatan, 'kabupaten' => $kabupaten]);
    }

    public function tambah(Request $request)
    {
        $data = [
            'kecamatan' => $request->kecamatan,
            'id_kabupaten' => $request->id_kabupaten,
        ];

        Kecamatan::create($data);
        Alert::success('Success', 'Data Berhasil ditambahkan', '1500');
        return to_route('kecamatan.index');
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::find($id);
        return response()->json($kecamatan);
    }

    public function update(Request $request, $id_kecamatan)
    {
        $request->validate([
            'kecamatan' => 'required|string|max:255',
            'id_kabupaten' => 'required|exists:kabupatens,id_kabupaten',
        ]);

        $kecamatan = Kecamatan::find($id_kecamatan);

        if (!$kecamatan) {
            Alert::error('Error', 'Kecamatan tidak ditemukan');
            return redirect()->route('kecamatan.index');
        }

        $kecamatan->kecamatan = $request->kecamatan;
        $kecamatan->id_kabupaten = $request->id_kabupaten;
        $kecamatan->save();
        Alert::success('Success', 'Data Berhasil diupdate', '1500');
        return redirect()->route('kecamatan.index');
    }

    public function destroy($id_kecamatan)
    {
        $kecamatan = Kecamatan::find($id_kecamatan);
        if ($kecamatan) {
            $kecamatan->delete();
            Alert::success('Success', 'Kecamatan Berhasil dihapus', '1500');
            return redirect()->route('kecamatan.index');
        } else {
            Alert::error('Error', 'Kecamatan Tidak Dapat dihapus', '1500');
            return redirect()->route('kecamatan.index');
        }
    }
}
