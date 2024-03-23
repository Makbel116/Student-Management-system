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

    public function show(Teacher $teacher){
        return view("Teachers.show",['columns'=>array_keys($teacher->getAttributes()),'teacher'=>$teacher]);
    }

    public function destroy(Teacher $teacher){
        $courses = $teacher->course;

        // Loop through each course and access the students
        foreach ($courses as $course) {
            $students = $course->student;
            foreach ($students as $student) {
                $student->delete();
            }
            $course->delete();
        }
    
        // Delete the teacher
        $teacher->delete();


        return redirect('/teachers')->with("message","deleted successfully!!!");
   }
}
