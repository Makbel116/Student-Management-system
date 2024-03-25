<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BatchController extends Controller
{
    //to get the list of the batches

    public function index()
    {
        return view('Batches.index', ["batches" => Batch::latest()->get()]);
    }

    public function create()
    {
        return view('Batches.create', ["teachers" => Teacher::all(), "courses" => Course::all()]);
    }
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('courses', 'name')],
            'place' => 'required',
            'time' => '',
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'teacher_id' => '',
            'course_id' => ''

        ]);


        Batch::create($formFields);
        return redirect('/batches')->with('message', 'batch created successfully!!!');
    }

    public function show(Batch $batch)
    {

        return view(
            "Batches.show",
            [
                'columns' => array_keys($batch->getAttributes()),
                "batch" => $batch,
                "teachers" => $batch->teacher()->get(),
                "students" => $batch->students()->get(),
                "courses" => $batch->course()->get(),
            ]
        );
    }


    public function edit(Batch $batch)
    {

        $students=$batch->students()->get();
             $most_preffered='';
             $mor=$aftr=0;
             foreach ($students as $student) {
                 if($student->preffered_time=='Morning'){
                     $mor+=1;
                 }
                 if($student->preffered_time=='Afternoon'){
                     $aftr+=1;
                 }
             }
             if($aftr>$mor){
                 $most_preffered='Afternoon with '.floor($aftr/count($students)*100).'%';
             }elseif($aftr<$mor){
                 $most_preffered='Morning with '.floor($mor/count($students)*100).'%';
             }else{
                 $most_preffered='Equally Morning & Afternoon';
             }


        return view(
            "Batches.edit",
            [
                "batch" => $batch,
                "teachers" => Teacher::all(),
                "courses" => Course::all(),
                'most_preffered'=>$most_preffered
            ]
        );
    }


    public function update(Batch $batch,Request $request){
        $formFields = $request->validate([
            'name' => ['required'],
            'place' => 'required',
            'time' => '',
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'teacher_id' => '',
            'course_id' => ''

        ]);

        $batch->update($formFields);

        return redirect('/batch/' . $batch->id . '/view')->with('batch updated successfully!!!');
    }

    public function destroy(Batch $batch)
    {
         $batch->delete();

         return redirect('/students')->with("message", "batch deleted successfully!!!");
    }

}
