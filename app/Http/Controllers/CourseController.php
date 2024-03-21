<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //

    public function index(){
        return view ("Courses.index",['courses'=>Course::latest()->get(),'title'=>'Course List']);
    }
}
