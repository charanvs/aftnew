<?php

namespace App\Http\Controllers;

use App\Models\CaseRegistration;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Scrutiny;
use App\Models\Applicant;
use App\Models\Disposed;

class DiaryController extends Controller
{
    public function ShowDiary()
    {
        return view('frontend.diary.index');
    } // end mehtod

    public function DiarySearch(Request $request)
    {
        $query = Scrutiny::query();
    
        // Join with CaseRegistration to ensure registration_no is always available
        $query->leftJoin('case_registrations', 'scrutinies.id', '=', 'case_registrations.sid')
              ->select('scrutinies.*', 'case_registrations.registration_no as registration_no');
    
        // If caseno is provided, filter by registration_no
        if ($request->has('caseno') && !empty($request->caseno)) {
            $query->where('case_registrations.registration_no', 'LIKE', '%' . $request->caseno . '%');
        }
    
        // If diaryno is provided, filter by diary_no
        if ($request->has('diaryno') && $request->diaryno != '') {
            $query->join('applicants', 'scrutinies.id', '=', 'applicants.sid')
                  ->where('scrutinies.diary_no', 'LIKE', '%' . $request->diaryno . '%')
                  ->select('scrutinies.*', 'case_registrations.registration_no', 'applicants.name as name');
        }
    
        // If applicant is provided, filter by applicant's name
        if ($request->has('applicant') && !empty($request->applicant)) {
            $query->join('applicants', 'scrutinies.id', '=', 'applicants.sid')
                  ->where('applicants.name', 'LIKE', '%' . $request->applicant . '%')
                  ->select('scrutinies.*', 'case_registrations.registration_no', 'applicants.name as name');
        }
    
        $cases = $query->paginate(100000);
    
        return response()->json($cases);
    }
    
    public function ShowDiaryData(Request $request)
{
    // Find the Scrutiny record by the provided ID
    $diary = Scrutiny::findOrFail($request->id);

    // First, check if the diary exists in the disposeds table
    $disposedCase = Disposed::where('diaryno', $diary->diary_no)->first();

    // If not found in disposeds, check in case_registrations table
    $caseRegistration = null;
    if (!$disposedCase) {
        $caseRegistration = CaseRegistration::where('diaryno', $diary->diary_no)->first();
    }

    // Find notifications that are associated with the Scrutiny record's ID
    $notifications = Notification::where('sid', $diary->id)->get();

    // Prepare the data to be returned
    $data = [
        'id' => $diary->id,
        'diaryno' => $diary->diary_no,
        'nature_of_doc' => $diary->nature_of_doc,
        'presented_by' => $diary->presented_by,
        'reviewed_by' => $diary->reviewed_by,
        'associated_with' => $diary->associated_with,
        'date_of_presentation' => $diary->date_of_presentation,
        'nature_of_grievance' => $diary->nature_of_grievance,
        'subject' => $diary->subject,
        'result' => $diary->result,
        'so_remark' => $diary->section_officer_remark,
        'dr_remark' => $diary->deputy_registrar_remark,
        'pr_remark' => $diary->registrar_remark,
        'nc_observations' => $diary->not_completed_observations,
        'no_of_applicants' => $diary->no_of_applicants,
        'no_of_respondents' => $diary->no_of_respondents,
        'status' => null, // Add status field to hold status value
    ];

    // Check if the diary is found in the disposeds table
    if ($disposedCase) {
        $data['disposed'] = [
            'regno' => $disposedCase->regno,
            'status' => $disposedCase->status,
        ];
        $data['status'] = $disposedCase->status; // Set status from disposedCase
        $data['message'] = "Case has already been disposed. For orders please search in judgements registration no - {$disposedCase->regno}"; // Set the custom message
    } elseif ($caseRegistration) {
        // If the diary is found in case_registrations
        $data['registration_no'] = $caseRegistration->registration_no;
        $data['dol'] = $caseRegistration->dol;
        $data['status'] = $caseRegistration->status ?? 'Pending'; // Set a default status if not found
        $data['message'] = "Case has already been Registered and Registration No is - {$caseRegistration->registration_no}"; // Set the custom message
    } elseif ($notifications->isNotEmpty()) {
        // Debug to check if notifications exist
        \Log::info('Notifications:', $notifications->toArray());
        
        // Map notifications
        $data['notifications'] = $notifications->map(function ($notification) {
            return [
                'id' => $notification->id,
                'sid' => $notification->sid,
                'defect' => $notification->defect,
                'rectified_by' => $notification->rectified_by,
                'nature' => $notification->nature,
                'time_granted' => $notification->time_granted,
                'rectified' => $notification->rectified,
                'created_at' => $notification->created_at,
                'updated_at' => $notification->updated_at,
            ];
        });
    } else {
        // If the diary is not found in disposeds, case_registrations, or notifications
        $data['message'] = "Diary No {$diary->diary_no} has not been scrutinized as yet.";
    }

    return response()->json($data);
}


}
