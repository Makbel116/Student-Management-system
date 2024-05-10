<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
     $this->middleware('permission:create users', ['only' => ['store']]);
     $this->middleware('permission:update users', ['only' => ['edit','update']]);
     $this->middleware('permission:read users', ['only' => ['user_settings']]);
     $this->middleware('permission:delete users', ['only' => ['destroy']]);

    }
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
    //to get the settings

    public function user_settings(){
        return view("Users.user_settings",[
            'users'=>User::all()
        ]);
    }

    //to store a user

    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required'],
            'username' => ['required', 'min:4', 'no_spaces', Rule::unique('users', 'username')],
            'email'=> ['required','email'],
            'password' => ['required', 'min:6',"confirmed"]
        ]); 
        $formFields['password']=bcrypt($formFields['password']);

        $user=User::create($formFields);
        
        return redirect('/user')->with("message", 'Users Registered Successfully!!!');

    }
    //to show the edit page

    public function edit(User $user){

        return view("Users.edit",[
            'roles'=>Role::all(),
            'user'=>$user
        ]);
    }


    //to update a user status

    public function update(User $user,Request $request){
        $formFields = $request->validate([
            'name' => ['required'],
            'username' => ['required', 'min:4', 'no_spaces'],
            'email'=> ['required','email'],
            'password' => ['required', 'min:6',"confirmed"]
        ]); 

        $formFields['password']=bcrypt($formFields['password']);

        $assigned_roles = $request->input('assigned_roles', []);
        $not_assigned_roles = $request->input('not_assigned_roles', []);

        
        if($assigned_roles){
            foreach($assigned_roles as $role){
                $user->removeRole(Role::find($role));
            }
        }
        if($not_assigned_roles){
            foreach($not_assigned_roles as $role){
                $user->assignRole(Role::find($role));
            }
        }
        
        $user->update($formFields);

        return redirect("/user")->with('message', 'role updated successfully');

    }
    //to delete a user

    public function destroy(Request $request,User $user){
        $user->delete();
        return redirect('/user')->with("message", 'User deleted Successfully!!!');

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
    public function forgot_password()
    {
        return view("Users.forgetpassword");
    }

    public function reset_password($token, $username)
    {
        return view("Users.resetpassword", compact('token', 'username'));
    }

    public function update_password($token, $username, Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6|confirmed'
        ]);


        $user = User::where('username', $username)->first();

        
        if (!$user) {
            return redirect()->back()->with('error', 'Invalid user.');
        }
        $tokenData = DB::table('password_resets')
            ->where('token', $token)->first();

        if (!$tokenData) {
            return redirect('/forgot-password')->with('error', 'Invalid token.');
        }
        if (Carbon::now()->diffInHours($tokenData->created_at) >= 1) {
            $tokenData->delete(); // Invalidate expired token
            return redirect('/forgot-password')->with('error', 'Token expired.');
        }
    
        $user->forceFill([
            'password' => Hash::make($request->new_password)
        ])->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

    DB::table('password_resets')->where('email', $user->email)
    ->delete();

        return redirect('/login')->with('message', 'Your password has been successfully reset!');
    }
}
