<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InterviewScheduled extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $interviewDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($application, $interviewDetails)
    {
        $this->application = $application;
        $this->interviewDetails = $interviewDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.interview_scheduled')
        ->subject('Jadwal Interview')
        ->with([
            'application' => $this->application,
            'interviewDetails' => $this->interviewDetails,
        ]);
    }
}
