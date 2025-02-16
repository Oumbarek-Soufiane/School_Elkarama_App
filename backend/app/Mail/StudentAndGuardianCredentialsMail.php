<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentAndGuardianCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $studentName;
    protected $studentEmail;
    protected $studentPassword;
    protected $guardianName;
    protected $guardianEmail;
    protected $guardianPassword;
    /**
     * Create a new message instance.
     */
    public function __construct($studentName, $studentEmail, $studentPassword, $guardianName, $guardianEmail, $guardianPassword)
    {
        $this->studentName = $studentName;
        $this->studentEmail = $studentEmail;
        $this->studentPassword = $studentPassword;

        $this->guardianName = $guardianName;
        $this->guardianEmail = $guardianEmail;
        $this->guardianPassword = $guardianPassword;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Student And Guardian Credentials',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.student_guardian_credentials',
            with: [
                'studentName' => $this->studentName,
                'studentEmail' => $this->studentEmail,
                'studentPassword' => $this->studentPassword,
                'guardianName' => $this->guardianName,
                'guardianEmail' => $this->guardianEmail,
                'guardianPassword' => $this->guardianPassword
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
