<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
     //

     public function index()
     {

          return view("Student.index", ["students" => Student::latest()->get(), "title" => "Student List"]);
     }
     public function create()
     {

          return view("Student.create", ["courses" => Course::select('id', 'name', 'place')->get()]);
     }
     public function store(Request $request)
     {
          $formFields = $request->validate([
               'name' => ['required'],
               'age' => ['max:3'],
               'email' => ['email', Rule::unique('students', 'email')],
               'phone_number' => ['required', 'min:10'],
               'status'=>'',
               'gender'=>'',
               'location'=>'',
               'preffered_time'=>'',
               'recommendation'=>'',
               'course_id'=>''
          ]);
          // dd($formFields);

          Student::create($formFields);
          return redirect('/students')->with("message",'Student Registered!!!');
     }
}
