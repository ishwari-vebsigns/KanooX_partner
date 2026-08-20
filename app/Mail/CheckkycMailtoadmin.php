<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckkycMailtoadmin extends Mailable
{
    use Queueable, SerializesModels;
    public $mailDataAdmin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailDataAdmin)
    {
        $this->mailDataAdmin = $mailDataAdmin;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.checkkyctoadmin');
    }
}
