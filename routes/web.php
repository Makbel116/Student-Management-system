<?php

use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
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


//to get the home page(

Route::get('/',[UserController::class,'index']);

//to get the list of students
Route::get('/students', [StudentController::class,'index']);


//to get the list of courses
Route::get('/courses', [CourseController::class,'index']);


//to get the list of teachers
Route::get('/teachers', [TeacherController::class,'index']);
