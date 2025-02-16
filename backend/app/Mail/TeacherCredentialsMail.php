<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TeacherCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $TeacherFirstName;
    protected $TeacherLastName;
    protected $TeacherEmail;
    protected $TeacherPassword;
    /**
     * Create a new message instance.
     */
    public function __construct($TeacherFirstName,
     $TeacherLastName,
     $TeacherEmail,
     $TeacherPassword)
    {
        
        $this->TeacherFirstName = $TeacherFirstName;
        $this->TeacherLastName = $TeacherLastName;
        $this->TeacherEmail = $TeacherEmail;
        $this->TeacherPassword = $TeacherPassword;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Teacher Credentials Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.teacher_credentials',
            with: [
                'teacher_last_name' => $this->TeacherLastName,
                'teacher_first_name' => $this->TeacherFirstName,
                'teacherEmail' => $this->TeacherEmail,
                'teacherPassword' => $this->TeacherPassword,
                
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
