<?php

namespace App\Mail;

use App\Publication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class mailToCandidate extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $publication;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Publication $publication)
    {
        $this->user = $user;
        $this->publication = $publication;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.mailToCandidate');
    }
}
