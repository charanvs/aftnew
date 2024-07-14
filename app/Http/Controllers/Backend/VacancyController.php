<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancy = Vacancy::latest()->get();
        return view('backend.vacancy.all_vacancy', compact('vacancy'));
    }

    public function AddVacancy()
    {
        return view('backend.vacancy.add_vacancy');
    } // End Method

    public function StoreVacancy(Request $request)
    {
        // Step 2: Validate the File
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'file' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);
        // Step 3: Store the File
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/vacancy'), $fileName);
            $save_url = $fileName;

            // Step 4: Insert the Data into Vacancy model
            Vacancy::insert([
                'title' => $request->title,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'file' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Vacancy Data Inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.vacancy')->with($notification);
        }

        $notification = array(
            'message' => 'File Upload Fails',
            'alert-type' => 'danger'
        );

        return back()->with($notification);
    }

    public function EditVacancy($id)
    {

        $vacancy = Vacancy::findOrFail($id);
        return view('backend.vacancy.edit_vacancy', compact('vacancy'));
    } // End Method


    public function UpdateVacancy(Request $request)
    {
        // Step 1: Find the Vacancy by ID
        $vacancy = Vacancy::findOrFail($request->id);

        // Step 2: Validate the Input Data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'file' => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048', // file is optional
        ]);
        // Step 3: Update the File if a New One is Uploaded
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($vacancy->file && Storage::disk('public')->exists('uploads/vacancy/' . basename($vacancy->file))) {
                Storage::disk('public')->delete('upload/vacancy/' . basename($vacancy->file));
            }

            // Store the new file
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            // $filePath = $file->storeAs('uploads/vacancy', $fileName, 'public');
            $save_url = 'upload/vacancy/' . $fileName;

            // Update the file path in the database
            $vacancy->file = $save_url;
        }



        // Step 4: Update the Vacancy Details
        $vacancy->title = $request->title;
        $vacancy->description = $request->description;
        $vacancy->start_date = $request->start_date;
        $vacancy->end_date = $request->end_date;
        $vacancy->updated_at = Carbon::now();

        // Step 5: Save the Changes
        $vacancy->save();

        $notification = array(
            'message' => 'Record Updated Successfully!',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function DeleteVacancy($id)
    {
        // Step 1: Find the Vacancy by ID
        $vacancy = Vacancy::findOrFail($id);

        // Step 2: Delete the File if it Exists
        if ($vacancy->file && Storage::disk('public')->exists($vacancy->file)) {
            Storage::disk('public')->delete($vacancy->file);
        }

        // Step 3: Delete the Vacancy Record
        $vacancy->delete();

        return back()->with('success', 'Vacancy deleted successfully');
    }
}
