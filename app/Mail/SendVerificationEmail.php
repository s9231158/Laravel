<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendVerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
   
     */
    protected $user;
    
    public function __construct(\App\Models\User $user)
    {
        $this->user = $user;
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Verification Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'verification',
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
    public function build()
    {
        // return $this->subject('Send Verification Email')
        //     ->view('emails.verification'); // 修改成您的郵件視圖路徑
        
        return $this->from('example@example.com', 'Example')
        ->subject('訂單成立')
        ->view('verification',['user' => $this->user]);
    }
}
