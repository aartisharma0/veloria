<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionThanksMail extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct(public string $email) {}
    public function envelope(): Envelope { return new Envelope(subject: 'Welcome to Veloria Newsletter!'); }
    public function content(): Content { return new Content(markdown: 'emails.subscription-thanks'); }
}
