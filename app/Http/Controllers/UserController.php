<?php

namespace App\Http\Controllers;

use App\Models\Batch;
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
        $students = Student::latest()->filter(request(['search']))->get();
        $courses = Course::latest()->get();
        $batches = Batch::latest()->get();
        $teachers = Teacher::latest()->get();

        $StudentCount = count($students);
        $CourseCount = count($courses);
        $BatchCount = count($batches);
        $TeacherCount = count($teachers);

        $dataFromViewforPie = $courses->pluck('name')->toArray();
        $dataFromViewforBar = $batches->pluck('name')->toArray();
        $studentCountsPerBatch = $batches->map(function ($batch) {
            return $batch->students->count();
        })->toArray();
        $studentCountsPerCourse = $courses->map(function ($course) {
            $studentCount = $course->batch->flatMap(function ($batch) {
                return $batch->students;
            })->count();
            return $studentCount;
        })->toArray();
        return view(
            "Users.index",
            compact(
                'students',
                'courses',
                'batches',
                'StudentCount',
                'CourseCount',
                'BatchCount',
                'TeacherCount',
                'dataFromViewforPie',
                'dataFromViewforBar',
                'studentCountsPerBatch',
                'studentCountsPerCourse'
            )
        );
    }
    //to show the login page
    public function login()
    {
        return view("Users.login");
    }
    ///user authentcation
    public function authentcation(Request $request)
    {
        $formFields = $request->validate([
            'username' => ['required', 'min:4', 'no_spaces'],
            'password' => ['required', 'min:6']
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'successfully logged in!!');
        }
        return back()->withErrors(['username' => "Invalid Credentials"])->onlyInput('username');
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'logged out successfully!!!');
    }
}
