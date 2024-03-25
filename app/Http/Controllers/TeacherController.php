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

        return view("Teachers.index", ["teachers" => Teacher::latest()->get()]);
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
        return redirect('/teachers')->with("message", 'Teacher Registered Successfully!!!');
    }

    public function show(Teacher $teacher){
        $batches=$teacher->batch()->get();
        return view("Teachers.show",['columns'=>array_keys($teacher->getAttributes()),'teacher'=>$teacher,"batches"=>$batches]);
    }

    public function destroy(Teacher $teacher){
        
        // Delete the teacher
        $teacher->delete();


        return redirect('/teachers')->with("message","teacher deleted successfully!!!");
   }

   public function edit(Teacher $teacher){
    return view('Teachers.edit',["teacher"=>$teacher]);
}
    public function update(Teacher $teacher,Request $request){
        $formFields = $request->validate([
            'name' => ['required'],
            'age' => ['max:3'],
            'email' => ['email'],
            'phone_number' => ['required', 'min:10'],
            'status' => '',
            'gender' => '',
            'location' => '',
            'preffered_time' => '',

        ]);

        $teacher->update($formFields);
        return redirect('/teacher/'.$teacher->id.'/view')->with('message','teacher updated successfully');
    }
}
