<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMailNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $user = [];

    public function __construct($user)
    {
        $this->user=$user;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->from('minhhung.dx1805@gmail.com', 'test')
                    ->subject('Reset Password')
                    ->view('email.reset-password')
                    ->with([
                        'user' => $this->user,
                    ]);
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
