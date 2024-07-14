<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class CalendarController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('backend.calendar.calendar', compact('events'));
    }

    public function store(Request $request)
    {
        $event = Event::create($request->all());
        return response()->json($event);
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json(['success' => true]);
    }
}
