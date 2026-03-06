<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $events = Event::withCount('users')->orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'speaker' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'total_seats' => 'required|integer|min:1',
        ]);

        Event::create($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'speaker' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'total_seats' => 'required|integer|min:1',
        ]);

        $event->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Event deleted successfully.');
    }

    public function students(Event $event)
    {
        $students = $event->users()->where('role', 'student')->get();
        return view('admin.events.students', compact('event', 'students'));
    }
}
