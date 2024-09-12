<?php

namespace App\Http\Controllers\karyawan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiKaryawanController extends Controller
{
    public function index()
    {
        // Fetch all attendance data
        $data = Absensi::all();

        // Return the view with attendance data
        return view('karyawan.absensi', compact('data'));
    }
}
