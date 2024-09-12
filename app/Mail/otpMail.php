<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $otp;
    public $otpExpiry;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $otp, $otpExpiry)
    {
        $this->user = $user;
        $this->otp = $otp;
        $this->otpExpiry = $otpExpiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('auth.verify-otp')
            ->subject('Email Verification OTP')
            ->with([
                'user' => $this->user,
                'otp' => $this->otp,
                'otpExpiry' => $this->otpExpiry,
            ]);
    }
}
