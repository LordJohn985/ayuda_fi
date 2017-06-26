<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class mailToCandidateOnDelete extends Mailable
{
    use Queueable, SerializesModels;

    public $publication;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Publication $publication)
    {
        $this->publication = $publication;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.mailToCandidateOnDelete');
    }
}
