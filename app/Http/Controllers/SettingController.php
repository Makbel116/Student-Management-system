<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Place;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;


class SettingController extends Controller
{
    //to show the settigs page

    public function index()
    {
        return view(
            "Settings.index",
            [
                'schedules' => Schedule::orderBy('name')->get(),
                'locations' => Location::orderBy('name')->get(),
                'places' => Place::orderBy('name')->get()
            ]
        );
    }




    //schedule

    //to show the edit for the schedule

    public function schedule_edit()
    {
        return view(
            'Schedules.edit',
            [
                'schedules' => Schedule::orderBy('name')->get()
            ]
        );
    }


    //to save added schedule
    public function schedule_store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('schedules', 'name')]
        ]);
        Schedule::create($formFields);
        return redirect("/schedule/edit")->with('message', 'schedule created successfully');
    }

    //to delete schedule

    public function schedule_destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect("/schedule/edit")->with("message", "schedule deleted successfully!!!");
    }


    //locatio
    //to show the edit page for the location
    public function location_edit()
    {
        return view(
            'Location.edit',
            [
                'locations' => Location::orderBy('name')->get()
            ]
        );
    }

    //to save the added location
    public function location_store(Request $request)
    {

        $formFields = $request->validate([
            'name' => ['required', Rule::unique('locations', 'name')]
        ]);

        Location::create($formFields);

        return redirect("/location/edit")->with("message", "location deleted successfully!!!");
    }

    //to delete location
    public function location_destroy(Location $location)
    {
        $location->delete();

        return redirect("/location/edit")->with("message", "location deleted successfully!!!");
    }




    //places
    //to show the edit page for the place
    public function place_edit()
    {
        return view(
            'Places.edit',
            [
                'places' => Place::orderBy('name')->get()
            ]
        );
    }

    //to save the added place
    public function place_store(Request $request)
    {

        $formFields = $request->validate([
            'name' => ['required', Rule::unique('places', 'name')]
        ]);

        Place::create($formFields);

        return redirect("/place/edit")->with("message", "place deleted successfully!!!");
    }

    //to delete place
    public function place_destroy(Place $place)
    {
        $place->delete();

        return redirect("/place/edit")->with("message", "place deleted successfully!!!");
    }
}
