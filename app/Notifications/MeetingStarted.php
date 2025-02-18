<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MeetingStarted extends Notification
{
    use Queueable;

    protected $meeting;

    public function __construct($meeting)
    {
        $this->meeting = $meeting;
    }

    public function via($notifiable)
    {
        return ['database']; // Simpan notifikasi ke database
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Rapat Dimulai!',
            'message' => "Rapat '{$this->meeting->title}' telah dimulai.",
            'meeting_id' => $this->meeting->id,
        ];
    }
}


