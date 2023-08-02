<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmProposalEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $recipient;
    public $body;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $recipient
     * @param string $body
     * @return void
     */
    public function __construct($subject, $recipient, $body)
    {
        $this->subject = $subject;
        $this->recipient = $recipient;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->to($this->recipient)
                    ->view('mail.confirmproposal')
                    ->with('body', $this->body);
    }
}
