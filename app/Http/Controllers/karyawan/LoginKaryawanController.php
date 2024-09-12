<?php

namespace App\Http\Controllers\karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;

class LoginKaryawanController extends Controller
{
    public function index()
    {
        return view('karyawan.login');
    }

    public function login(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba untuk login user
        $credentials = $request->only('username', 'password');

        // Menggunakan guard yang sesuai
        if (Auth::guard('pegawai')->attempt(['username' => $request->username, 'password' => $request->password])) {
            // Autentikasi berhasil...
            if (Auth::guard('pegawai')->check()) {
                $user = Auth::guard('pegawai')->user();

                // Cek di tabel pegawai
                if ($user && $user->usertype == '2') {
                    // Simpan ID pegawai di sesi
                    $request->session()->put('id_pegawai', $user->id);

                    return redirect()->intended('/karyawan/dashboard');
                } else {
                    // Logout pengguna yang tidak valid
                    Auth::guard('pegawai')->logout();
                    return redirect()->back()->with('message', 'Anda bukan pegawai yang terdaftar.');
                }
            }
        }

        // Autentikasi gagal...
        return redirect()->back()->with('message', 'Username atau Password salah.');
    }
}
