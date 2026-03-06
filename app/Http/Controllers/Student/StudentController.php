<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $events = Event::withCount('users')->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        $registeredEventIds = $user->events->pluck('id')->toArray();
        $registrationCount = count($registeredEventIds);

        return view('student.events.index', compact('events', 'registeredEventIds', 'registrationCount'));
    }

    public function registerForEvent(Request $request, Event $event)
    {
        $user = auth()->user();

        // Check 1: Max 3 events per student
        if ($user->events()->count() >= 3) {
            return redirect()->back()->with('error', 'You can only register for a maximum of 3 events.');
        }

        // Check 2: Pre-check duplicate registration (Double Registration constraint check logic)
        if ($user->events()->where('event_id', $event->id)->exists()) {
             return redirect()->back()->with('error', 'You are already registered for this event.');
        }

        // Check 3: Seat limit condition
        // re-fetch the event to avoid race condition slightly, count real-time DB users count.
        $currentRegistrations = $event->users()->count();
        if ($currentRegistrations >= $event->total_seats) {
            return redirect()->back()->with('error', 'This event is full.');
        }

        try {
            $user->events()->attach($event->id);
        } catch (\Exception $e) {
            // Check 4: Catch DB-level Unique Constraint Exception (Double Registration)
            return redirect()->back()->with('error', 'Failed to register. You might be already registered.');
        }

        return redirect()->back()->with('success', 'Successfully registered for ' . $event->title);
    }

    public function unregisterFromEvent(Request $request, Event $event)
    {
        $user = auth()->user();

        if (!$user->events()->where('event_id', $event->id)->exists()) {
            return redirect()->back()->with('error', 'You are not registered for this event.');
        }

        $user->events()->detach($event->id);

        return redirect()->back()->with('success', 'Successfully cancelled registration for ' . $event->title);
    }
}
