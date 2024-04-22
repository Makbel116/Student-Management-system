<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $token;
    public $title;

    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
        $this->title = "Password Reset";
    }

    public function build()
    {


        return $this->markdown('Emails.mail')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->subject($this->title)
            ->with([
                "messageIntro" => "Hello, {$this->user->name}",
                "messageBody" => "
                You have requested a password reset for your account.
                Click the link below to reset your password:",
                "messageFooter" =>"This link will expire in " . config('auth.passwords.users.expire') . " minutes."
            ]);
    }
}
