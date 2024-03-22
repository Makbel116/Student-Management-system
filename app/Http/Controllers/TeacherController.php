<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    //
    public function index()
    {

        return view("Teachers.index", ["teachers" => Teacher::latest()->get(), "title" => "Teacher List"]);
    }
    public function create()
    {

        return view("Teachers.create",);
    }
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required'],
            'age' => ['max:3'],
            'email' => ['email', Rule::unique('teachers', 'email')],
            'phone_number' => ['required', 'min:10'],
            'status' => '',
            'gender' => '',
            'location' => '',
            'preffered_time' => '',
        ]);
        

        Teacher::create($formFields);
        return redirect('/teachers')->with("message", 'Teacher Registered!!!');
    }
}
