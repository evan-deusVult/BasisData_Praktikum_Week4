<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
    $events = Event::orderBy('start_at')->paginate(10);
        $freeEventsCount = Event::where('price', 0)->count();
        $upcomingEventsCount = Event::count();

        return view('events.index', compact('events', 'freeEventsCount', 'upcomingEventsCount'));
    }

    public function show($id)
    {
    $event = Event::findOrFail($id);
    return view('events.show', compact('event'));
    }

    public function register(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'university' => 'nullable|string|max:255',
        ]);

        // Check if event is not full
        if ($event->registered >= $event->capacity) {
            return response()->json(['error' => 'Event is full'], 400);
        }

        // Create registration record (you'll need to create this model/migration)
        // EventRegistration::create([
        //     'event_id' => $event->id,
        //     'name' => $validated['name'],
        //     'email' => $validated['email'],
        //     'phone' => $validated['phone'],
        //     'university' => $validated['university'],
        // ]);

        // Update registered count
        $event->increment('registered');

        return response()->json(['success' => true]);
    }
        public function destroy($id)
        {
            $event = Event::findOrFail($id);
            $event->delete();
        return redirect()->route('home')->with('success', 'Event berhasil dihapus.');
        }
}

