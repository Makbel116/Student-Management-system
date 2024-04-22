<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

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

Route::middleware(['middleware' => 'guest'])->group(function () {

    Route::controller(UserController::class)->group(function () {

        //to get to the login page

        Route::get('/login', 'login')->name('login');

        //to get forget password page

        Route::get("/forgot-password", 'forgot_password');

        //to get the reset for password page

        Route::get("/reset/{username}/{token}", 'reset_password');

        //to update the password

        Route::post("/reset/{username}/{token}", 'update_password');

        //user authentcation to login

        Route::post("/user/authentcation", 'authentcation');
    });
});




Route::middleware(['middleware' => 'auth'])->group(function () {

    Route::controller(UserController::class)->group(function () {

        //to get the home page

        Route::get('/', 'index');


        //user logout

        Route::post("/logout", 'logout');
    });


    //students

    Route::controller(StudentController::class)->group(function () {

        //to get the list of students
        Route::get('/students',  'index');

        Route::prefix('student')->group(function () {
            //to show a Student registeration page

            Route::get('/register',  'create');

            //to store the student

            Route::post('/store',  'store');

            //to view each student detail

            Route::get('/{student}/view',  'show');

            //to delete a certain student

            Route::delete('/{student}/delete',  'destroy');

            //to show edit page a student details

            Route::get('/{student}/edit',  'edit');

            //to update the edited student details

            Route::put('/{student}/update',  'update');

            //to dropout a student from a batch

            Route::post('/{student}/{batch}/dropout',  'dropout');

            //to remove a student from a batch

            Route::post('/{student}/{batch}/remove',  'remove');

            // to add a student to a new batch 

            Route::post('/{student}/assign',  'assign');
        });
    });



    //courses

    Route::controller(CourseController::class)->group(function () {
        //to get the list of courses
        Route::get('/courses', 'index');

        Route::prefix('course')->group(function () {

            //to show a course register page

            Route::get('/register', 'create');

            //to store created courses

            Route::post('/store', 'store');

            //to view each course detail

            Route::get('/{course}/view', 'show');

            //to delete a certain student

            Route::delete('/{course}/delete', 'destroy');

            //to show edit page a course details

            Route::get('/{course}/edit', 'edit');

            //to update the edited courses details

            Route::put('/{course}/update', 'update');
        });
    });


    //teachers
    Route::controller(TeacherController::class)->group(function () {
        //to get the list of teachers
        Route::get('/teachers',  'index');

        Route::prefix('teacher')->group(function () {

            //to show the registeratio page for teachers

            Route::get('/register',  'create');

            //to store the teacher

            Route::post('/store',  'store');

            //to view each teacher detail

            Route::get('/{teacher}/view',  'show');

            //to delete a certain student

            Route::delete('teacher/{teacher}/delete',  'destroy');

            //to show edit page a teacher details

            Route::get('/{teacher}/edit',  'edit');

            //to update the edited teacher details

            Route::put('/{teacher}/update',  'update');
        });
    });

    //batches

    Route::controller(BatchController::class)->group(function () {

        // to get the list of the batches
        Route::get('/batches', 'index');

        Route::prefix('batch')->group(function () {

            //to show a batches register page

            Route::get('/register', 'create');

            //to store the batch

            Route::post('/store', 'store');

            //to view each batch detail

            Route::get('/{batch}/view', 'show');

            //to show edit page a batch details

            Route::get('/{batch}/edit', 'edit');

            //to update the edited batch details

            Route::put('/{batch}/update', 'update');

            //to delete a certain batch

            Route::delete('batch/{batch}/delete', 'destroy');
        });
    });


    //settings
    Route::controller(SettingController::class)->group(function () {

        // to view the settings page
        Route::get('/settings', 'index');

        // schedule
        Route::prefix('schedule')->group(function () {

            //to show the edit page for schedule
            Route::get('/edit', 'schedule_edit');

            //to add a new schedule
            Route::post('/store', 'schedule_store');

            //to delete a schedule

            Route::delete('/{schedule}/delete', 'schedule_destroy');
        });



        // location

        Route::prefix('location')->group(function () {

            //to show the edit page for location
            Route::get('/edit', 'location_edit');

            //to add a new location
            Route::post('/store', 'location_store');

            //to delete a location

            Route::delete('/{location}/delete', 'location_destroy');
        });




        // places

        Route::prefix('place')->group(function () {

            //to show the edit page for place
            Route::get('/edit', 'place_edit');

            //to add a new place
            Route::post('/store', 'place_store');

            //to delete a place

            Route::delete('/{place}/delete', 'place_destroy');
        });
    });

    // certificate

    //to generate a certificate

    Route::post('/generate-pdf/{batch}', [PDFController::class, 'generatePDF']);


    //mail

    //to send the email for the user

    Route::post("/forgot-password-email", [MailController::class, 'send_forget_email']);
    
});
