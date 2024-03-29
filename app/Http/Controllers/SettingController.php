<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;


class SettingController extends Controller
{
    //

    public function index()
    {
        return view(
            "Settings.index",
            [
                'schedules' => Schedule::all(),
                'locations' => Location::all()
            ]
        );
    }

    public function schedule_edit(){
       return view ( 'Schedules.edit',['schedules' => Schedule::all()]);
    }

    public function schedule_store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('schedules', 'name')]
        ]);
        Schedule::create($formFields);
        return redirect("/schedule/edit")->with('message', 'schedule created successfully');
    }

    public function schedule_destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect("/schedule/edit")->with("message", "schedule deleted successfully!!!");
    }

    public function location_edit(){
        return view ('Location.edit',['locations' => Location::all()]);
    }

    public function location_store(Request $request){

        $formFields=$request->validate([
            'name' => ['required', Rule::unique('locations', 'name')]
        ]);

        Location::create($formFields);

        return redirect("/location/edit")->with("message", "location deleted successfully!!!");
    }

    public function location_destroy(Location $location)
    {
        $location->delete();

        return redirect("/location/edit")->with("message", "location deleted successfully!!!");
    }
}
