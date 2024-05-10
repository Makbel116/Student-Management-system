<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Location;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class StudentController extends Controller
{    

     public function __construct()
    {
     $this->middleware('permission:create students', ['only' => ['create','store']]);
     $this->middleware('permission:update students', ['only' => ['edit','update']]);
     $this->middleware('permission:read students', ['only' => ['index']]);
     $this->middleware('permission:delete students', ['only' => ['destroy']]);

    }
     //

     public function index()
     {
          return view(
               "Student.index",
               [
                    "students" => Student::latest()->get(),
                    "title" => "Student List"
               ]
          );
     }
     public function create()
     {

          return view(
               "Student.create",
               [
                    "batches" => Batch::select('id', 'name')->get(),
                    "locations" => Location::orderBy('name')->get()
               ]
          );
     }
     public function store(Request $request)
     {
          $formFields = $request->validate([
               'name' => ['required'],
               'age' => ['max:2'],
               'email' => ['email', Rule::unique('students', 'email','required')],
               'phone_number' => ['required', 'min:10'],
               'status' => '',
               'gender' => '',
               'location_id' => '',
               'preffered_time' => '',
               'recommendation' => '',
               'remaining_payment' => ''

          ]);

          $student = Student::create($formFields);
          MailController::send_welcome_email($student);

          return redirect('/students')->with("message", 'Student registered successfully!!!');
     }

     public function show(Student $student)
     {
          $batches = $student->batches()->get();
          return view(
               "Student.show",
               [
                    'columns' => array_keys($student->getAttributes()),
                    'student' => $student,
                    "batches" => $batches
               ]
          );
     }

     public function destroy(Student $student)
     {
          $student->delete();

          return redirect('/students')->with("message", "student deleted successfully!!!");
     }

     public function edit(Student $student)
     {
     
          return view(
               'Student.edit',
               [
                    "student" => $student,
                    "batches" => Batch::select('id', 'name')->get(),
                    "locations" => Location::orderBy('name')->get()
               ]
          );
     }

     public function update(Request $request, Student $student)
     {
          $formFields = $request->validate([
               'name' => ['required'],
               'age' => ['max:2'],
               'email' => ['email'],
               'phone_number' => ['required', 'min:10'],
               'status' => '',
               'gender' => '',
               'location_id' => '',
               'preffered_time' => '',
               'recommendation' => '',
               'remaining_payment' => "",

          ]);



          $student->update($formFields);
          return redirect('/student/' . $student->id . '/view')->with("message", 'student updated successfully!!!');
     }


     public function dropout(Student $student, Batch $batch)
     {

          // Append the new drop_out value using a consistent separator
          $existingDropout = $student->drop_out;

          if ($existingDropout !== null) {
               $student->drop_out = $existingDropout . ' ' . $batch->name;
          } else {
               $student->drop_out = $batch->name;
          }

          // Save the student record with the updated drop_out 
          $student->save();

          // Detach the student from the batch
          $student->batches()->detach($batch);

          // Return a success message with proper redirection
          return redirect('/student/' . $student->id . '/view')
               ->with('message', 'Student successfully dropped out from batch!');
     }

     public function remove(Student $student, Batch $batch)
     {

          // Remove From a batch
          
               $student->batches()->detach($batch);

               return redirect('/student/' . $student->id . '/view')
               ->with('message', 'Student successfully removed from batch!');
     }

     public function assign(Student $student,Request $request){

          $student->batches()->attach(Batch::find($request->batch));

          return redirect('/student/' . $student->id . '/view')
               ->with('message', 'Student successfully added to batch!');
     }
}
