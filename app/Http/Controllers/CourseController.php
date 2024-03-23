<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    //

    public function index()
    {
        return view("Courses.index", ['courses' => Course::latest()->get(), 'title' => 'Course List']);
    }
    public function create()
    {

        return view("Courses.create", ['teachers' => Teacher::select('id', 'name')->get()]);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('courses', 'name')],
            'place' => 'required',
            'time' => '',
            'Starting_date' => ['required', 'date'],
            'Ending_date' => ['required', 'date'],
            'teacher_id' => ''

        ]);
        Course::create($formFields);
        return redirect('/courses')->with('message', 'course added successfully!!!');
    }

    public function show(Course $course)
    {
        return view("Courses.show", ['columns' => array_keys($course->getAttributes()), 'course' => $course]);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        $course->student()->delete();

        return redirect('/courses')->with("message", "deleted successfully!!!");
    }

    public function  edit(Course $course){
        $students=$course->student;
        $most_preffered='';
        $mor=$aftr=0;
        foreach ($students as $student) {
            if($student->preffered_time=='Morning'){
                $mor+=1;
            }
            if($student->preffered_time=='Afternoon'){
                $aftr+=1;
            }
        }
        if($aftr>$mor){
            $most_preffered='Afternoon with '.floor($aftr/count($students)*100).'%';
        }elseif($aftr<$mor){
            $most_preffered='Morning with '.floor($mor/count($students)*100).'%';
        }else{
            $most_preffered='Equally Morning & Afternoon';
        }

        return view("Courses.edit", ['course'=>$course,'teachers' => Teacher::select('id', 'name')->get(),'most_preffered'=>$most_preffered]);
    }

    public function update(Course $course,Request $request){
        $formFields=$request->validate([
            'name' => ['required'],
            'place' => 'required',
            'time' => '',
            'Starting_date' => ['required', 'date'],
            'Ending_date' => ['required', 'date'],
            'teacher_id' => ''
        ]);
        
        $course->update($formFields);

        return redirect('/course/'.$course->id.'/view')->with('message','Updated successfully!!!');
    }
}
