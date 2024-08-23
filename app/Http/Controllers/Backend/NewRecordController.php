<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewRecord;
use Carbon\Carbon;

class NewRecordController extends Controller
{
    public function index()
    {
        $new_records = NewRecord::latest()->get();
        return view('backend.new_record.all_records', compact('new_records'));
    }

    public function AddRecord()
    {
        return view('backend.new_record.add_record');
    } // End Method

    public function StoreRecord(Request $request)
    {
        // Step 2: Validate the File
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'closing_date' => 'required|date',
            'type' => 'required',
            'file' => 'required|mimes:jpg,png,jpeg,pdf|max:2048',
        ]);
        // Step 3: Store the File
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/tender_notifications'), $fileName);
            $save_url = $fileName;

            // Step 4: Insert the Data into Vacancy model
            NewRecord::insert([
                'title' => $request->title,
                'description' => $request->description,
                'closing_date' => $request->closing_date,
                'type' => $request->type,
                'pdfname' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => $request->type . ' Inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.docs')->with($notification);
        }

        $notification = array(
            'message' => 'File Upload Fails',
            'alert-type' => 'danger'
        );

        return back()->with($notification);
    }

    public function edit($id)
    {
        $doc = NewRecord::findOrFail($id);
        return view('backend.new_record.edit_record', compact('doc'));
    } // End Method

    public function update(Request $request)
    {
        // Step 1: Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'closing_date' => 'required|date',
            'type' => 'required',
            'file' => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048', // Making file nullable
        ]);

        // Find the record by ID
        $doc = NewRecord::findOrFail($request->id);

        // Step 2: Check if a new file is uploaded
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'upload/tender_notifications/' . $fileName;
            $file->move(public_path('upload/tender_notifications'), $fileName);

            // Delete the old file if it exists
            if ($doc->pdfname && file_exists(public_path($doc->pdfname))) {
                unlink(public_path($doc->pdfname));
            }

            // Update the document's file path with the new file
            $doc->pdfname = $fileName;
        }

        // Step 3: Update the other document details
        $doc->title = $request->title;
        $doc->description = $request->description;
        $doc->closing_date = $request->closing_date;
        $doc->type = $request->type;

        // Save the updated document record
        $doc->save();

        // Step 4: Set up a success notification
        $notification = array(
            'message' => 'Record updated successfully',
            'alert-type' => 'success'
        );

        // Redirect to a route with a success message
        return redirect()->route('all.docs')->with($notification);
    }
}
