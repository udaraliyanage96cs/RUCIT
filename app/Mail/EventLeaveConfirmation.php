<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventLeaveConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $registration;
    /**
     * Create a new message instance.
     */
    public function __construct($registration)
    {
        $this->registration = $registration;
    }

    public function build(){
        return $this->subject('Event Leave Confirmation')
                    ->view('emails.event_leave_confirmation');
    }
}
