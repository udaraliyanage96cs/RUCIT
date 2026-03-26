<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class APIController extends Controller
{
    public function getData(Request $request){
        $events = Event::orderBy('id','desc')->get();

        return response()->json([
            'success' => true,
            'events' => $events
        ],200);
    }

    public function store(Request $request){
        $event = Event::create([
            'event_title' => $request->event_title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'location' => $request->location,
            'max_participants' => $request->max_participants,
            'status' => $request->status
        ]);

        // $event = Event::create($request->all());


        return response()->json([
            'success' => true,
            'message' => "Evenet created successfully",
            'data' => $event
        ],201);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $event->update([
            'event_title' => $request->event_title,
            'event_description' => $request->description,
            'location' => $request->location,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'status' => $request->status,
            'max_participants' => $request->max_participants
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully',
            'data' => $event
        ]);
    }


    public function delete(Request $request){
        $event = Event::find($request->id);
        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event Deleted Successfully'
        ],200);

    }

    public function event(Request $request){
        $event = Event::find($request->id);
        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    }
}
