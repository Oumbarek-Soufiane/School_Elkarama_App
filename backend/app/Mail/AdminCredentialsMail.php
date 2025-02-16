<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $adminFirstName;
    protected $adminLastName;
    protected $adminEmail;
    protected $adminPassword;


    /**
     * Create a new message instance.
     */
    public function __construct($adminFirstName, $adminLastName, $adminEmail, $adminPassword)
    {
        $this->adminFirstName =  $adminFirstName;
        $this->adminLastName =  $adminLastName;
        $this->adminEmail = $adminEmail;
        $this->adminPassword =  $adminPassword;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin Credentials Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_credentials',
            with: [
                'adminFirstName' => $this->adminFirstName,
                'adminLastName' => $this->adminLastName,
                'adminEmail' => $this->adminEmail,
                'adminPassword' => $this->adminPassword,
            ],
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