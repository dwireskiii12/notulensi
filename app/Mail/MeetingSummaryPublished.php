<?php

namespace App\Mail;

use App\Models\Summary;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class MeetingSummaryPublished extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $summary;
    public $recipientName;
    /**
     * Create a new message instance.
     */
    public function __construct(Summary $summary, $recipientName)
    {
        //
        $this->summary = $summary;
        $this->recipientName = $recipientName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Meeting Summary Published',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.meeting_summary_published',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
