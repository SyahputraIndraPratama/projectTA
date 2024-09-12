<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        // Fetch all attendance data
        $data = Absensi::all();

        // Return the view with attendance data
        return view('admin.absensi', compact('data'));
    }
}
