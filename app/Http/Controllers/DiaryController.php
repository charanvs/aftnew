<?php

namespace App\Http\Controllers;

use App\Models\CaseRegistration;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Scrutiny;
use App\Models\Applicant;

class DiaryController extends Controller
{
    public function ShowDiary()
    {
        return view('frontend.diary.index');
    } // end mehtod

    public function DiarySearch(Request $request)
    {
        $query = Scrutiny::query();

        if ($request->has('caseno') && !empty($request->caseno)) {
            $query = CaseRegistration::join('scrutinies as s', 'case_registrations.sid', '=', 's.id')
                ->where('case_registrations.registration_no', 'LIKE', '%' . $request->caseno . '%');
        }

        if ($request->has('diaryno') && $request->diaryno != '') {
            $query->join('applicants', 'scrutinies.id', '=', 'applicants.sid')
                ->where('scrutinies.diary_no', 'LIKE', '%' . $request->diaryno . '%');
        }

        if ($request->has('applicant') && !empty($request->applicant)) {
            $query = Applicant::join('scrutinies as s', 'applicants.sid', '=', 's.id')
                ->where('applicants.name', 'LIKE', '%' . $request->applicant . '%');
        }

        $cases = $query->paginate(10);

        return response()->json($cases);
    }

    public function ShowDiaryData(Request $request)
    {
        $diary = Scrutiny::findOrFail($request->id);
        $notifications = Notification::where('sid', $request->id)->get();

        // Adjust this part according to your actual database structure
        $data = [
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
            'notifications' => $notifications, // Add notifications to the response data
        ];

        return response()->json($data);
    }
}
