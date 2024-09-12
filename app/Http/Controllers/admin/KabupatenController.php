<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use RealRashid\SweetAlert\Facades\Alert;

class KabupatenController extends Controller
{
    public function index()
    {
        $kabupaten = Kabupaten::with('provinsi')->get();
        $provinsi = Provinsi::all();
        return view('admin.kabupaten', ['data' => $kabupaten, 'provinsi' => $provinsi]);
    }

    public function tambah(Request $request)
    {
        $data = [
            'kabupaten' => $request->kabupaten,
            'id_provinsi' => $request->id_provinsi,
        ];

        Kabupaten::create($data);
        Alert::success('Success', 'Data Berhasil ditambahkan', '1500');
        return to_route('kabupaten.index');
    }

    public function edit($id)
    {
        $kabupaten = Kabupaten::find($id);
        return response()->json($kabupaten);
    }

    public function update(Request $request, $id_kabupaten)
    {
        $request->validate([
            'kabupaten' => 'required|string|max:255',
            'id_provinsi' => 'required|exists:provinsis,id_provinsi',
        ]);

        $kabupaten = Kabupaten::find($id_kabupaten);

        if (!$kabupaten) {
            Alert::error('Error', 'Kabupaten tidak ditemukan');
            return redirect()->route('kabupaten.index');
        }

        $kabupaten->kabupaten = $request->kabupaten;
        $kabupaten->id_provinsi = $request->id_provinsi;
        $kabupaten->save();
        Alert::success('Success', 'Data Berhasil diupdate', '1500');
        return redirect()->route('kabupaten.index');
    }

    public function destroy($id_kabupaten)
    {
        $kabupaten = Kabupaten::find($id_kabupaten);
        if ($kabupaten) {
            $kabupaten->delete();
            Alert::success('Success', 'Kabupaten Berhasil dihapus', '1500');
            return redirect()->route('kabupaten.index');
        } else {
            Alert::error('Error', 'Kabupaten Tidak Dapat dihapus', '1500');
            return redirect()->route('kabupaten.index');
        }
    }
}
