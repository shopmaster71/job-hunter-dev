<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResponseToVakancy extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public array $data,
    ) {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('no-reply@job-hunter.ru', 'No-reply'),
            subject: "Новое сообщение на сайте Job Hunter",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.response-vacancy',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        $attachments = [];

        // Если передан путь к резюме
        if (!empty($this->data['resume'])) {
            $fullPath = public_path($this->data['resume']);

            if (file_exists($fullPath)) {
                $attachments[] = \Illuminate\Mail\Mailables\Attachment::fromPath($fullPath)
                    ->as('резюме_' . $this->data['applicant_name'] . '.' . pathinfo($fullPath, PATHINFO_EXTENSION))
                    ->withMime(mime_content_type($fullPath));
            }
        }

        return $attachments;
    }
}
