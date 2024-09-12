<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use Illuminate\Http\Request;

class TambahBagianController extends Controller
{
    public function index()
    {
        $tambahbagian = Bagian::all();
        return view('admin.perusahaan.tambah_bagian', ['data' => $tambahbagian]);
    }
}
