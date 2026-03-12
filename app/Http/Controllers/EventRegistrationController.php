<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration;
use App\Models\Event;

class EventRegistrationController extends Controller
{
    /**
     * POST /api/events/join
     * Join an event (authenticated users only).
     */
    public function join(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $userId  = $request->user()->id;
        $eventId = $request->event_id;

        // Check if already registered
        $existing = EventRegistration::where('user_id', $userId)
            ->where('event_id', $eventId)
            ->first();

        if ($existing) {
            if ($existing->status === 'registered') {
                return response()->json([
                    'message' => 'You have already joined this event.',
                    'registration' => $existing,
                ], 409);
            }

            // Re-activate a previously cancelled registration
            $existing->update(['status' => 'registered']);
            return response()->json([
                'message' => 'Successfully re-joined the event!',
                'registration' => $existing->load('event'),
            ]);
        }

        // Check max_participants cap
        $event = Event::findOrFail($eventId);
        if ($event->max_participants) {
            $count = EventRegistration::where('event_id', $eventId)
                ->where('status', 'registered')
                ->count();

            if ($count >= $event->max_participants) {
                return response()->json([
                    'message' => 'This event is fully booked.',
                ], 422);
            }
        }

        $registration = EventRegistration::create([
            'user_id'  => $userId,
            'event_id' => $eventId,
            'status'   => 'registered',
        ]);

        return response()->json([
            'message'      => 'Successfully joined the event!',
            'registration' => $registration->load('event'),
        ], 201);
    }

    /**
     * DELETE /api/events/leave/{event_id}
     * Leave (cancel) an event registration.
     */
    public function leave(Request $request, $eventId)
    {
        $registration = EventRegistration::where('user_id', $request->user()->id)
            ->where('event_id', $eventId)
            ->where('status', 'registered')
            ->first();

        if (!$registration) {
            return response()->json([
                'message' => 'You are not registered for this event.',
            ], 404);
        }

        $registration->update(['status' => 'cancelled']);

        return response()->json([
            'message' => 'You have left the event.',
        ]);
    }

    /**
     * GET /api/my-events
     * Get all events the authenticated user has joined.
     */
    public function myEvents(Request $request)
    {
        $registrations = EventRegistration::with('event')
            ->where('user_id', $request->user()->id)
            ->where('status', 'registered')
            ->latest()
            ->get();

        return response()->json([
            'registrations' => $registrations,
        ]);
    }

    /**
     * GET /api/events/{event_id}/registrations  (admin use)
     * Get all users registered for a specific event.
     */
    public function eventRegistrations($eventId)
    {
        $registrations = EventRegistration::with('user')
            ->where('event_id', $eventId)
            ->where('status', 'registered')
            ->get();

        return response()->json([
            'event_id' => $eventId,
            'count'    => $registrations->count(),
            'registrations' => $registrations,
        ]);
    }
}
