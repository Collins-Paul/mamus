<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivateAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $MailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($MailData)
    {
        //
        $this->MailData = $MailData;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Account Activation')->view('emails.account-activation');
    }
}
