<?php

namespace App\Jobs;

use App\Mail\OtpMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpEmail;
use App\Models\User;

class SendOtpEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $otp;
    protected $otpExpiry;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $otp, $otpExpiry)
    {
        $this->user = $user;
        $this->otp = $otp;
        $this->otpExpiry = $otpExpiry;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new otpMail($this->user, $this->otp, $this->otpExpiry));
    }
}
