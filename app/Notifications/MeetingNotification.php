<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\Meeting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MeetingNotification extends Notification
{
    use Queueable;
    public $meeting;
    /**
     * Create a new notification instance.
     */
    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray( $notifiable): array
    {
        return [
            'message' => 'Jadwal rapat baru telah diajukan.',
            'meeting_id' => $this->meeting->meeting_id,
            'title' => $this->meeting->meeting_theme,
            'date' => Carbon::parse($this->meeting->start_time)->toDateTimeString(),
        ];
    }
}
