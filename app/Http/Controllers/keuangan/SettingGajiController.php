<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use App\Models\SettingsGaji;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingGajiController extends Controller
{
    public function index()
    {
        $settings = SettingsGaji::first();
        return view('keuangan.settingsgaji', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bpjs' => 'required|numeric',
            'pajak' => 'required|numeric',
        ]);

        // Update or Create new record with id_setting
        SettingsGaji::updateOrCreate(
            ['id_setting' => 1], // Assuming there is only one settings record with id_setting = 1
            [
                'bpjs' => $request->bpjs,
                'pajak' => $request->pajak
            ]
        );

        Alert::success('Success', 'Data Gaji Berhasil disimpan', '1500');
        return redirect()->route('settingsgaji.index');
    }
}
