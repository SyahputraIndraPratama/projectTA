<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JadwalInterviewNotification extends Notification
{
    use Queueable;

    protected $interview;

    public function __construct($interview)
    {
        $this->interview = $interview;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Interview Scheduled')
            ->line('Your interview has been scheduled.')
            ->line('Details:')
            ->line('Alamat: ' . $this->interview['alamat'])
            ->line('Tanggal: ' . $this->interview['tanggal'])
            ->line('PIC: ' . $this->interview['pic'])
            ->line('Telp PIC: ' . $this->interview['telp']);
    }

    public function toArray($notifiable)
    {
        return [
            // Data array for database notifications
        ];
    }
}
