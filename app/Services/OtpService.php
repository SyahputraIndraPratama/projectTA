<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Auth;

class OtpService
{
    public function sendOtp()
    {
        // Dapatkan pengguna yang sedang masuk
        $user = Auth::user();

        // Buat OTP acak
        $otp = rand(
            100000,
            999999
        );

        // Perbarui pengguna dengan OTP dan waktu kedaluwarsa
        $user->otp = $otp;
        $user->otp_expiry = now()->addMinutes(10);
        $user->save();

        // Kirim email OTP
        Mail::to($user->email)->send(new OtpMail($otp));

        return redirect()->back()->with('status', 'OTP telah dikirim ke email Anda.');
    }
}
