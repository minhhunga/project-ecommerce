<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    private $data = [];
    /**
     * Create a new message instance.
     * @return void
     */
    
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     * @return $this
     */
    
    public function build()
    {
        return $this->from('minhhung.dx1805@gmail.com', "test")
                    ->subject($this->data['subject'])
                    ->view('email.index')
                    ->with([
                        'user' => $this->data['user'],
                        'cart' => $this->data['cart'],
                        'sum' => $this->data['sum'],
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
