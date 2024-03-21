<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index()
    {
        return view("Users.index", ['students' => Student::latest()->simplepaginate(5), 'courses' => Course::latest()->paginate(5), 'teachers' => Teacher::latest()->paginate(5)]);
    }
}
