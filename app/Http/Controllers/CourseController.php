<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    //

    public function index(){
        return view ("Courses.index",['courses'=>Course::latest()->get(),'title'=>'Course List']);
    }
    public function create(){
        
        return view("Courses.create",['teachers'=>Teacher::select('id', 'name')->get()]);
   }

   public function store(Request $request){
    $formFields=$request->validate([
        'name'=>['required',Rule::unique('courses','name')],
        'place'=>'required',
        'time'=>'',
        'Starting_date'=>['required','date'],
        'Ending_date'=>['required','date'],
        'teacher_id'=>''

    ]);
    Course::create($formFields);
    return redirect('/courses')->with('message','course added successfully!!!');
   }

   public function show(Course $course){
    return view("Courses.show",['columns'=>array_keys($course->getAttributes()),'course'=>$course]);
}
}
