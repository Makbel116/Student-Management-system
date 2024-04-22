<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompletionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $batch;
    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($student, $batch)
    {
        $this->student = $student;
        $this->batch = $batch;
        $this->title = "Letter of Completion";
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
                "messageBody" => "We thrilled to congratulate you on successfully completing the course {$this->batch->course->name} with us. Your dedication and hard work throughout the course are truly commendable.",
                "messageFooter"  => " Please don't hesitate to reach out if you have any questions or need further guidance related to the course material.
            I wish you all the best in your future academic and professional pursuits."
            ]);
    }
}
