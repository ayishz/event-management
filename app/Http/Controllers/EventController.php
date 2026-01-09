<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    if ($search) {
        $events = Event::where('title', 'like', "%$search%")
                       ->orWhere('event_date', 'like', "%$search%")
                       ->get();
    } else {
        $events = Event::all();
    }

    return view('events.index', compact('events'));
}


    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'image' => $imagePath
        ]);

        return redirect()->route('events.index')->with('success','Event created');
    }
    public function edit($id)
{
    $event = Event::findOrFail($id);
    return view('events.edit', compact('event'));
}

public function update(Request $request, $id)
{
    $event = Event::findOrFail($id);

    $request->validate([
        'title' => 'required',
        'image' => 'image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $data = $request->only(['title', 'description', 'event_date', 'location']);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('events', 'public');
    }

    $event->update($data);

    return redirect()->route('events.index')->with('success','Event updated successfully');
}

public function destroy($id)
{
    $event = Event::findOrFail($id);
    
    // Delete image from storage
    if ($event->image) {
        \Storage::disk('public')->delete($event->image);
    }

    $event->delete();

    return redirect()->route('events.index')->with('success','Event deleted successfully');
}

}
