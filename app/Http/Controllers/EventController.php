<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->get(['id', 'title', 'start', 'end', 'category', 'pdfUrl']);

            return response()->json($data);
        }

        return view('frontend.calendar');
    }

    public function ajax(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            'category' => 'required|string|in:Cause List,Holidays',
            'pdfUrl' => 'required_if:category,Cause List|nullable|url'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pdfUrl = $request->pdfUrl ? url($request->pdfUrl) : null;

        switch ($request->type) {
            case 'add':
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                    'category' => $request->category,
                    'pdfUrl' => $pdfUrl,
                ]);

                return response()->json($event);
                break;

            case 'update':
                $event = Event::find($request->id);
                $event->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                    'category' => $request->category,
                    'pdfUrl' => $pdfUrl,
                ]);

                return response()->json($event);
                break;

            case 'delete':
                $event = Event::find($request->id);
                $event->delete();

                return response()->json($event);
                break;

            default:
                return response()->json(['error' => 'Invalid Request Type'], 400);
        }
    }

    public function getEvents(Request $request)
    {
        $events = Event::all(); // Adjust this query to fetch events as per your requirements

        $eventArray = [];
        foreach ($events as $event) {
            $eventArray[] = [
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
                'category' => $event->category,
                'pdfUrl' => asset($event->pdfurl) // Make sure these fields exist in your Event model
            ];
        }

        return response()->json($eventArray);
    }
}
