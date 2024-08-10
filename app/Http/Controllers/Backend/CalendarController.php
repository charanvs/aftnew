<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Event;

class CalendarController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('backend.calendar.all_event', compact('events'));
    }

    public function add()
    {
        return view('backend.calendar.add_event');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            // Conditionally require 'pdfurl' if category is not 'Holiday'
            'pdfurl' => $request->category !== 'Holiday' ? 'required|file' : 'nullable|file',
        ]);

        $pdfPath = null;

        // Handle the file upload only if the category is not 'Holiday' and a file is provided
        if ($request->hasFile('pdfurl') && $request->category !== 'Holiday') {
            // Get the uploaded file
            $pdfFile = $request->file('pdfurl');
            // Define the file name with a unique identifier to prevent overwriting
            $fileName = time() . '_' . $pdfFile->getClientOriginalName();
            // Move the file to the desired location in the public/pdf directory
            $pdfFile->move(public_path('pdf'), $fileName);
            $pdfPath = 'pdf/' . $fileName;
        }

        Event::insert([
            'category' => $request->category,
            'title' => $request->title,
            'start' => $request->start_date,
            'end' => $request->end_date,
            'pdfurl' => $pdfPath, // Store the relative path to the file or null if not provided
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Daily Cause List Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('calendar')->with($notification);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('backend.calendar.edit_calendar', compact('event'));
    } // End Method

    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'pdfurl' => $request->category === 'Cause List' ? 'nullable|file|mimes:pdf' : 'nullable', // PDF is required only for Cause List
        ]);

        // Find the event by ID
        $event = Event::findOrFail($request->id);

        // Update the event details
        $event->category = $request->category;
        $event->title = $request->title;
        $event->start = $request->start_date;
        $event->end = $request->end_date;

        // Handle the PDF file upload if the category is Cause List and a file is uploaded
        if ($request->category === 'Cause List' && $request->hasFile('pdfurl')) {
            // Delete the old file if it exists
            if ($event->pdfurl && file_exists(public_path($event->pdfurl))) {
                unlink(public_path($event->pdfurl));
            }

            // Upload the new file
            $pdfFile = $request->file('pdfurl');
            $fileName = time() . '_' . $pdfFile->getClientOriginalName();
            $pdfFile->move(public_path('pdf'), $fileName);
            $event->pdfurl = 'pdf/' . $fileName;
        } elseif ($request->category !== 'Cause List') {
            // If the category is not "Cause List", clear the pdfurl field
            $event->pdfurl = null;
        }

        // Save the updated event record
        $event->save();

        // Set up a success notification
        $notification = array(
            'message' => 'Event updated successfully',
            'alert-type' => 'success'
        );

        // Redirect to a route with a success message
        return redirect()->route('calendar')->with($notification);
    }
}
