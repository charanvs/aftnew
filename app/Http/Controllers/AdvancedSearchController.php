<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaseRegistration;
use App\Models\Judgement;
use App\Models\CaseDependency;
use App\Models\Scrutiny;


class AdvancedSearchController extends Controller
{
    public function AdvancedSearch()
    {
        return view('frontend.search.index');
    }
   public function searchPerform(Request $request)
{
    if ($request->filled('search_type') && $request->filled('keyword')) {
        $searchType = $request->input('search_type');
        $keyword = $request->input('keyword');

        // Initialize the base query depending on the search type
        $query = null;
        $resultType = '';

        switch ($searchType) {
            // Queries for Orders (CaseRegistration model)
            case 'order_registration_no':
                $query = CaseRegistration::where('registration_no', 'like', '%' . $keyword . '%');
                $resultType = 'Order';
                break;
            case 'order_applicant':
                $query = CaseRegistration::where('applicant', 'like', '%' . $keyword . '%');
                $resultType = 'Order';
                break;
            case 'order_advocate':
                $query = CaseRegistration::where(function ($q) use ($keyword) {
                    $q->where('radvocate', 'like', '%' . $keyword . '%')
                      ->orWhere('padvocate', 'like', '%' . $keyword . '%');
                });
                $resultType = 'Order';
                break;
            case 'order_dol':
                $query = CaseDependency::where('case_dependencies.dol', 'like', '%' . $keyword . '%')
                    ->join('case_registrations', 'case_registrations.id', '=', 'case_dependencies.regid')
                    ->select('case_registrations.*', 'case_dependencies.dol as dependency_dol', 'case_dependencies.courtno');
                $resultType = 'Order';
                break;

            // Queries for Judgements (Judgement model)
            case 'judgements_registration_no':
                $query = Judgement::where('regno', 'like', '%' . $keyword . '%');
                $resultType = 'Judgement';
                break;
            case 'judgements_applicant':
                $query = Judgement::where('petitioner', 'like', '%' . $keyword . '%');
                $resultType = 'Judgement';
                break;
            case 'judgements_advocate':
                $query = Judgement::where(function ($q) use ($keyword) {
                    $q->where('radvocate', 'like', '%' . $keyword . '%')
                      ->orWhere('padvocate', 'like', '%' . $keyword . '%');
                });
                $resultType = 'Judgement';
                break;
            case 'judgements_case_type':
                $query = Judgement::where('case_type', 'like', '%' . $keyword . '%');
                $resultType = 'Judgement';
                break;
            case 'judgements_dor':
                $query = Judgement::where('dod', 'like', '%' . $keyword . '%');
                $resultType = 'Judgement';
                break;
            case 'judgements_subject':
                $query = Judgement::where('subject', 'like', '%' . $keyword . '%');
                $resultType = 'Judgement';
                break;

            // Queries for Diary (Scrutiny model)
            case 'diary_applicant':
                $query = Scrutiny::join('applicants', 'applicants.sid', '=', 'scrutinies.id')
                    ->where('applicants.name', 'like', '%' . $keyword . '%')
                    ->select('scrutinies.*', 'applicants.name as applicant_name');
                $resultType = 'Diary';
                break;

            case 'diary_diaryno':
                $query = Scrutiny::where('diary_no', 'like', '%' . $keyword . '%')
                    ->join('applicants', 'scrutinies.id', '=', 'applicants.sid')
                    ->select('scrutinies.*', 'applicants.name as applicant_name');
                $resultType = 'Diary';
                break;

            case 'diary_presentation_date':
                $query = Scrutiny::where('date_of_presentation', 'like', '%' . $keyword . '%')
                    ->join('applicants', 'scrutinies.id', '=', 'applicants.sid')
                    ->select('scrutinies.*', 'applicants.name as applicant_name');
                $resultType = 'Diary';
                break;

            default:
                return response()->json(['error' => 'Invalid search type.'], 400);
        }

        if ($query) {
            
            // Use pagination instead of get() and return 10 results per page
            $results = $query->paginate(10)->appends($request->query());

            // Load the partial Blade view and pass results to it
            // $html = view('partials.search_results_table', compact('results', 'resultType', 'searchType'))->render();

            // Return JSON with the generated HTML
            return response()->json([
                'html' => view('partials.search_results_table', compact('results', 'resultType', 'searchType'))->render(),
                'pagination' => $results->links('vendor.pagination.custom')->render(),
            ]);
            
        }
    }

    return response()->json(['error' => 'Please provide a valid search type and keyword.'], 400);
}



    public function viewCaseDetails($id)
    {
        $case = CaseRegistration::findOrFail($id);
        $case->load('interimJudgements'); // Lazy loading of interimJudgements
        return view('case_details', compact('case'));
    }
}
