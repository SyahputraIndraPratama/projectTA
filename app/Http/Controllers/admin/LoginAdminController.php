<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request){
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication was successful...
            if (Auth::check()) {
                $user = Auth::user();

                // Check if the user has verified OTP
                //if (!$user->email_verified_at) {
                //    Auth::logout();
                //    return redirect()->route('login')->with('message', 'Silakan verifikasi OTP Anda sebelum login.');
                //}

                // Determine the user's type and redirect accordingly
                switch ($user->usertype) {
                    case '0':
                        return redirect()->intended('/');
                    case '1':
                        return redirect()->intended('/admin/home');
                    case '2':
                        return redirect()->intended('/hrd/home');
                    case '3':
                        return redirect()->intended('/keuangan/home');
                    case '4':
                        return redirect()->intended('/karyawan/dashboard');
                    default:
                        Auth::logout();
                        return redirect()->back()->with('message', 'Usertype tidak dikenali.');
                }
            }
        }

        // Authentication failed...
        return redirect()->back()->with('message', 'Username atau Password salah');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
