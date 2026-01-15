<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function createEvent(){
        $event = Event::create([
            'event_title' => 'Sample Event 2',
            'description' => 'Sample Description 2',
            'event_date' => '2026-01-08',
            'event_time' => '09:00:00',
            'location' => 'Colombo',
            'max_participants' => 20,
            'status' => 'inactive'
        ]);
        return response()->json([
            'message' => 'Event created successfully',
            'data' => $event
        ]);
    }

    public function getEvents(){
        $events = Event::all();
        dd($events);
    }

    public function getEvent(Request $request){
        $event = Event::find($request->id);
        dd($event);
    }

    public function updateEvent(Request $request){
        $event = Event::find($request->id);
        $event->update([
            'description' => 'sample updated description 2',
        ]);

        dd($event);
    }

    public function deleteEvent(Request $request){
        $event = Event::find($request->id);
        $event->delete();
    }
}
