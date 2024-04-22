<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\WelcomeMail;
use App\Mail\CompletionMail;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //

    public function send_forget_email(Request $request)
    {
        try {
            $this->validate($request, [
                'inputEmail' => 'required|email',
            ]);

            $email = $request->get('inputEmail');

            // Check if user exists in database using your User model
            $user = User::where('email', $email)->first();

            if (!$user) {
                return redirect("/forgot-password")->with("error", "The email address you entered is not associated with an account.");
            }

            $token = app('auth.password.broker')->createToken($user);

            //Create Password Reset Token
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

           

            // Use Laravel's Mail Facade to send the reset password email
            Mail::to($user->email)->send(new ForgotPasswordMail($user, $token));

            return redirect()->back()->with("message", 'A password reset link has been sent to your email address.');
        } catch (\Exception $e) {

            // dd($e);


            return redirect("/forgot-password")->with("error", $e->getMessage());
        }
    }

    public function send_welcome_email($student)
    {
        Mail::to($student->email)->send(new WelcomeMail($student));
    }

    public function send_completion_mail($student, $batch)
    {
        Mail::to($student->email)->send(new CompletionMail($student, $batch));
    }
}
