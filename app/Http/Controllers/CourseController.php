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
        return view(
            "Courses.index",
            [
                'courses' => Course::latest()->get(),
                'title' => 'Course List'
            ]
        );
    }
    public function create()
    {

        return view("Courses.create");
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('courses', 'name')],
            'description' => ['required'],
        ]);

        Course::create($formFields);
        return redirect('/courses')->with('message', 'course added successfully!!!');
    }

    public function show(Course $course)
    {
        $batches = $course->batch()->get();
        return view(
            "Courses.show",
            [
                'columns' => array_keys($course->getAttributes()),
                'course' => $course, "batches" => $batches
            ]
        );
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect('/courses')->with("message", "course deleted successfully!!!");
    }

    public function  edit(Course $course)
    {

        return view("Courses.edit", ['course' => $course]);
    }

    public function update(Course $course, Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required'],
            'description' => 'required',

        ]);

        $course->update($formFields);

        return redirect('/course/' . $course->id . '/view')->with('message', 'course updated successfully!!!');
    }
}
