<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //for the home page
    public function index()
    {
        return view("Users.index", ['students' => Student::latest()->simplepaginate(5), 'courses' => Course::latest()->paginate(5), 'teachers' => Teacher::latest()->paginate(5)]);
    }
    //to show the login page
    public function login(){
        return view("Users.login");
    }
    ///user authentcation
    public function authentcation(Request $request){
        $formFields=$request->validate([
            'username'=>['required','min:4','no_spaces'],
            'password'=>['required','min:6']
        ]);

        if (auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message','successfully logged in!!');
        }
        return back()->withErrors(['username'=>"Invalid Credentials"])->onlyInput('username');

    }
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message','logged out successfully!!!');

    }
}
