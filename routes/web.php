<?php

use App\Http\Controllers\BatchController;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\Course;
use App\Models\Student;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//to get the home page

Route::get('/',[UserController::class,'index'])->middleware('auth');

//to get to the login page

Route::get('/login',[UserController::class,'login'])->middleware('guest')->name('login');

//user authentcation to login

Route::post("/user/authentcation",[UserController::class,'authentcation']);

//user logout

Route::post("/logout",[UserController::class,'logout']);





//students

//to get the list of students
Route::get('/students', [StudentController::class,'index'])->middleware('auth');

//to show a Student registeration page

Route::get('/student/register',[StudentController::class,'create'])->middleware('auth');

//to store the student

Route::post('/student/store',[StudentController::class,'store'])->middleware('auth');

//to view each student detail

Route::get('/student/{student}/view',[StudentController::class,'show'])->middleware('auth');

//to delete a certain student

Route::delete('/student/{student}/delete',[StudentController::class,'destroy'])->middleware('auth'); 

//to show edit page a student details

Route::get('/student/{student}/edit',[StudentController::class,'edit'])->middleware('auth');

//to update the edited student details

Route::put('/student/{student}/update',[StudentController::class,'update'])->middleware('auth');





//courses

//to get the list of courses
Route::get('/courses', [CourseController::class,'index'])->middleware('auth');

//to show a course register page

Route::get('/course/register',[CourseController::class,'create'])->middleware('auth');

//to store created courses

Route::post('/course/store',[CourseController::class,'store'])->middleware('auth');

//to view each course detail

Route::get('/course/{course}/view',[CourseController::class,'show'])->middleware('auth');

//to delete a certain student

Route::delete('/course/{course}/delete',[CourseController::class,'destroy'])->middleware('auth'); 

//to show edit page a course details

Route::get('/course/{course}/edit',[CourseController::class,'edit'])->middleware('auth');

//to update the edited courses details

Route::put('/course/{course}/update',[CourseController::class,'update'])->middleware('auth');




//teachers

//to get the list of teachers
Route::get('/teachers', [TeacherController::class,'index'])->middleware('auth');

//to show the registeratio page for teachers

Route::get('/teacher/register',[TeacherController::class,'create'])->middleware('auth');

//to store the teacher

Route::post('/teacher/store',[TeacherController::class,'store'])->middleware('auth');

//to view each teacher detail

Route::get('/teacher/{teacher}/view',[TeacherController::class,'show'])->middleware('auth');

//to delete a certain student

Route::delete('teacher/{teacher}/delete',[TeacherController::class,'destroy'])->middleware('auth');

//to show edit page a teacher details

Route::get('/teacher/{teacher}/edit',[TeacherController::class,'edit'])->middleware('auth');

//to update the edited teacher details

Route::put('/teacher/{teacher}/update',[TeacherController::class,'update'])->middleware('auth');



//Batches

// to get the list of the batches
Route::get('/batches',[BatchController::class,'index']);


//to show a batches register page

Route::get('/batch/register',[BatchController::class,'create'])->middleware('auth');

//to store the batch

Route::post('/batch/store',[BatchController::class,'store'])->middleware('auth');

//to view each batch detail

Route::get('/batch/{batch}/view',[BatchController::class,'show'])->middleware('auth');

//to show edit page a batch details

Route::get('/batch/{batch}/edit',[BatchController::class,'edit'])->middleware('auth');

//to update the edited batch details

Route::put('/batch/{batch}/update',[BatchController::class,'update'])->middleware('auth');

//to delete a certain batch

Route::delete('batch/{batch}/delete',[BatchController::class,'destroy'])->middleware('auth');





//settings


// to view the settings page
Route::get('/settings',[SettingController::class,'index'])->middleware('auth');


//to add a new schedule
Route::post('/schedule/store',[SettingController::class,'store'])->middleware('auth');

//to delete a schedule

Route::delete('/schedule/{schedule}/delete',[SettingController::class,'destroy'])->middleware('auth');



