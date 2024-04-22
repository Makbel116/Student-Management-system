<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($student)
    {
        $this->student = $student;
        $this->title = "Welcome To Your Training";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Emails.mail')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->subject($this->title)
            ->with([
                "messageIntro" => "Hello, {$this->student->name}",
                "messageBody" => "
            Welcome to our Omishtu Joy certificate Program. We hope you have a great time with your training.
            If you have any question you would like to ask, please don't hesitate to do so using the following phone numbers.",
                "messageFooter" => "
            +251 911 111 111"
            ]);
    }
}
