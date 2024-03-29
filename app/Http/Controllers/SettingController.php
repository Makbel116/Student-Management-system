<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;


class SettingController extends Controller
{
    //

    public function index(){
        return view ("Settings.index",['schedules'=>Schedule::all()]);
    }

    public function store(Request $request){
        $formFields=$request->validate([
            'name'=>['required',Rule::unique('schedules', 'name')]
        ]);
        Schedule::create($formFields);
        return redirect("/settings")->with('message','schedule created successfully');
    }

    public function destroy(Schedule $schedule)
    {
         $schedule->delete();

         return redirect("/settings")->with("message", "schedule deleted successfully!!!");
    }
}
