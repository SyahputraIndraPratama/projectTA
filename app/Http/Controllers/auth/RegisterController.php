<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendOtpEmailJob;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Generate OTP and expiry
        $otp = Str::random(6);
        $otpExpiry = Carbon::now()->addMinutes(10);

        // Update user with OTP and expiry
        $user->otp = $otp;
        $user->otp_expiry = $otpExpiry;
        $user->save();

        // Dispatch job to send OTP email
        // SendOtpEmailJob::dispatch($user, $otp, $otpExpiry);
        Mail::to($user->email)->send(new OtpMail($user, $otp, $otpExpiry));

        // Redirect the user after registration
        return redirect()->route('showOtp')->with('status', 'Verification email sent. Please check your email.');
    }

    public function verifyOtp(Request $request)
    {
        $user = User::where('otp', $request->otp)->first();

        if ($user && Carbon::now()->lessThanOrEqualTo($user->otp_expiry)) {
            // OTP is valid
            $user->email_verified_at = now();
            $user->otp = null;
            $user->otp_expiry = null;
            $user->save();

            return redirect()->route('login')->with('status-success', 'Email verified successfully.');
        } else {
            // OTP is invalid or expired
            return redirect()->route('showOtp')->with('status-invalid', 'Invalid or expired OTP.');
        }
    }
    public function showViewOtp(Request $request)
    {
        return view('emails.otp');
    }
}
