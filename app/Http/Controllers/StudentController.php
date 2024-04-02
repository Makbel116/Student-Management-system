<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Location;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
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
               'email' => ['email', Rule::unique('students', 'email')],
               'phone_number' => ['required', 'min:10'],
               'status' => '',
               'gender' => '',
               'location_id' => '',
               'preffered_time' => '',
               'recommendation' => '',
               'remaining_payment'=>''

          ]);

          $student = Student::create($formFields);

          //assigns batches with students
          if ($request->batch_id) {
               $student->batches()->attach(Batch::find($request->batch_id));
          }

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
          // fetch all batches
          $all_batches = Batch::all();

          //fetch assigned_batches if the user wants to remove them
          $assigned_batches = $student->batches()->get();

          $not_assigned_batches = [];

          //checks if a batch is not assigned and not duplicated each time it is checked
          foreach ($all_batches as $batch) {
               $isAssigned = false;

               foreach ($assigned_batches as $assigned_batch) {
                    if ($batch->id === $assigned_batch->id) {
                         $isAssigned = true;
                         break;
                    }
               }

               if (!$isAssigned && !in_array($batch, $not_assigned_batches)) {
                    //puts not assigned batches if the user wants to assign them to  student
                    array_push($not_assigned_batches, $batch);
               }
          }


          return view(
               'Student.edit',
               [
                    "student" => $student,
                    "batches" => Batch::select('id', 'name')->get(),
                    "assigned_batch" => $assigned_batches,
                    "not_assigned_batches" => $not_assigned_batches,
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
               'assigned_batches' => '',
               'not_assigned_batches' => '',
               'remaining_payment'=>"",
               'drop_out'=>""

          ]);

          // Append the new drop_out value to the existing value
          $existingDropOut = $student->drop_out;
          if ($request->drop_out) {
                
               $formFields['drop_out'] = $existingDropOut . '  ' . $formFields['drop_out'];
                
               $student->batches()->detach(Batch::where('name', $student->drop_out)->first());
               
               $student->update($formFields);
           }
           else{
               $formFields['drop_out'] = $existingDropOut;
           }

            
          // Remove From a batch
          if ($request->assigned_batches) {
               $student->batches()->detach(Batch::find($request->assigned_batches));
          }

          // add to a batch
          if ($request->not_assigned_batches) {
               $student->batches()->attach(Batch::find($request->not_assigned_batches));
          }

          $student->update($formFields);
          return redirect('/student/' . $student->id . '/view')->with("message", 'student updated successfully!!!');
     }
}
