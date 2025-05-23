<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Place;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BatchController extends Controller
{
    public function __construct()
    {
     $this->middleware('permission:create batches', ['only' => ['create','store']]);
     $this->middleware('permission:update batches', ['only' => ['edit','update']]);
     $this->middleware('permission:read batches', ['only' => ['index']]);
     $this->middleware('permission:delete batches', ['only' => ['destroy']]);

    }

    //to get the list of the batches

    public function index()
    {
        return view('Batches.index', ["batches" => Batch::latest()->get()]);
    }

    public function create()
    {
        return view('Batches.create', [
            "teachers" => Teacher::orderBy('name')->get(),
            "courses" => Course::orderBy('name')->get(),
            "schedules" => Schedule::orderBy('name')->get(),
            "places" => Place::orderBy('name')->get()
        ]);
    }
    public function store(Request $request)
    {
        // dd($request);
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('batches', 'name')],
            'phase'=> ['required'],
            'place_id' => '',
            'schedule_id' => '',
            'start_date' => ['required', 'date','not_past_date'],
            'end_date' => ['required', 'date','not_past_date'],
            'teacher_id' => ['required'],
            'course_id' => ['required']

        ]);

        // dd($formFields);
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
                "schedules" => $batch->schedule()->get(),

            ]
        );
    }


    public function edit(Batch $batch)
    {

        $students = $batch->students()->get();
        $most_preffered = '';
        $mor = $aftr = 0;
        foreach ($students as $student) {
            if ($student->preffered_time == 'Morning') {
                $mor += 1;
            }
            if ($student->preffered_time == 'Afternoon') {
                $aftr += 1;
            }
        }
        if ($aftr > $mor) {
            $most_preffered = 'Afternoon with ' . floor($aftr / count($students) * 100) . '%';
        } elseif ($aftr < $mor) {
            $most_preffered = 'Morning with ' . floor($mor / count($students) * 100) . '%';
        } else {
            $most_preffered = 'Equally Morning & Afternoon';
        }


        return view(
            "Batches.edit",
            [
                "batch" => $batch,
                "teachers" => Teacher::orderBy('name')->get(),
                "courses" => Course::orderBy('name')->get(),
                'most_preffered' => $most_preffered,
                "schedules" => Schedule::orderBy('name')->get(),
                "places" => Place::orderBy('name')->get()
            ]
        );
    }


    public function update(Batch $batch, Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required'],
            'place_id' => '',
            'schedule_id' => '',
            'phase'=> ['required'],
            'start_date' => ['required', 'date','not_past_date'],
            'end_date' => ['required', 'date','not_past_date'],
            'teacher_id' => ['required'],
            'course_id' => ['required']

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
