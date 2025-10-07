<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::orderByDesc('start_at')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'status' => 'required|string|max:100',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required|string|max:255',
            'participants' => 'nullable|string|max:50',
            'price' => 'nullable|integer|min:0',
            'organizer' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|max:2048',
        ]);

        $event = new Event();
        $event->title = $validated['name'];
        $event->slug = \Str::slug($validated['name']) . '-' . uniqid();
        $event->category = $validated['category'];
        $event->status = $validated['status'];
        $event->venue = $validated['location'];
        $event->start_at = $validated['date'] . ' ' . $validated['start_time'];
        $event->end_at = $validated['date'] . ' ' . $validated['end_time'];
        $event->participants = $validated['participants'] ?? null;
        $event->price = $validated['price'] ?? 0;
        $event->organizer = $validated['organizer'] ?? null;
        $event->description = $validated['description'] ?? null;
        $event->is_published = true;

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('events', 'public');
            $event->poster_path = $path;
        }

        $event->save();
        return redirect('/')->with('success', 'Event berhasil ditambahkan!');
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'status' => 'required|string|max:100',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required|string|max:255',
            'participants' => 'nullable|string|max:50',
            'price' => 'nullable|integer|min:0',
            'organizer' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|max:2048',
        ]);

        $event->title = $validated['name'];
        $event->category = $validated['category'];
        $event->status = $validated['status'];
        $event->venue = $validated['location'];
        $event->start_at = $validated['date'] . ' ' . $validated['start_time'];
        $event->end_at = $validated['date'] . ' ' . $validated['end_time'];
        $event->participants = $validated['participants'] ?? null;
        $event->price = $validated['price'] ?? 0;
        $event->organizer = $validated['organizer'] ?? null;
        $event->description = $validated['description'] ?? null;

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('events', 'public');
            $event->poster_path = $path;
        }

        $event->save();
        return redirect()->route('home')->with('success', 'Event berhasil diupdate');
    }

    public function destroy(Event $event)
    {
    $event->delete();
    return redirect()->route('home')->with('success', 'Event berhasil dihapus');
    }
}
