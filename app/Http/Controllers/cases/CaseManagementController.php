<?php

namespace App\Http\Controllers\cases;

use App\Http\Controllers\Controller;
use App\Models\CaseDependency;
use Illuminate\Http\Request;
use App\Models\CaseRegistration;
use App\Models\InterimJudgement;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;



class CaseManagementController extends Controller
{
    public function ShowCases()
    {
        return view('cases.case_management');
    } // end mehtod
   
    public function CaseSearch(Request $request)
{
    $query = CaseRegistration::query();

    // Search by file number
    if ($request->has('fileno')) {
        $query->where('registration_no', 'LIKE', '%' . $request->fileno . '%');
    }

    // Search by party name
    if ($request->has('partyname')) {
        $query->where('applicant', 'LIKE', '%' . $request->partyname . '%');
    }

    // Search by advocate name
    if ($request->has('advocate')) {
        $query->where('padvocate', 'LIKE', '%' . $request->advocate . '%')
              ->orWhere('radvocate', 'LIKE', '%' . $request->advocate . '%');
    }

    // Search by case type
    if ($request->has('casetype')) {
        $query->where('case_type', $request->casetype);
    }

    // Search by case date (DOL)
    if ($request->has('casedate')) {
        // Convert the input date to match the format in your database
        $formattedDate = Carbon::createFromFormat('Y-m-d', $request->casedate)->format('d-m-Y'); // Assuming the string in DB is 'd-m-Y'
        $query->where('dol', $formattedDate);
    }

    // Search by interim_judgements based on dol
    if ($request->has('searchdate')) {
        // Convert the input date to match the format in your database
        $formattedSearchDate = Carbon::createFromFormat('Y-m-d', $request->searchdate)->format('d-m-Y');

        // Filter CaseRegistrations that have related InterimJudgements with matching dol
        $query->whereHas('interimJudgements', function ($q) use ($formattedSearchDate) {
            $q->where('dol', $formattedSearchDate);
        })
        ->with(['interimJudgements' => function ($q) use ($formattedSearchDate) {
            $q->where('dol', $formattedSearchDate)
              ->select('id', 'regid', 'dol', 'pdfname'); // Select only required fields
        }])
        // Include CaseDependency data (courtno and coram)
        ->with(['caseDependency' => function ($q) {
            $q->select('id', 'regid', 'courtno', 'coram'); // Select fields from CaseDependency
        }]);
    }

    // Paginate results
    $cases = $query->paginate(50000);

    return response()->json($cases);
}


    public function GeneratePDF($id)
    {

        // Fetch the case data using the ID
        $data = CaseRegistration::with('caseDependencies')->findOrFail($id);
        $data = $data->toArray();

        // Pdf::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf');

        // Generate the PDF
        $pdf = Pdf::loadView('pdf.case_details', compact('data'));
        return $pdf->download('case_details.pdf');


        // return Pdf::loadFile(public_path() . '/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');


        // Return the PDF as a response
        // return $pdf->download('case_details.pdf');
    }



    public function ShowCasesData(Request $request)
    {
        $caseRegistration = CaseRegistration::findOrFail($request->id);
        $interimJudgements = InterimJudgement::where('regid', $request->id)->get(['dol', 'pdfname']);

        $data = [
            'registration_no' => $caseRegistration->registration_no,
            'year' => $caseRegistration->year,
            'diaryno' => $caseRegistration->diaryno,
            'case_type' => $caseRegistration->case_type,
            'dor' => $caseRegistration->dor,
            'dol' => $caseRegistration->dol,
            'padvocate' => $caseRegistration->padvocate,
            'radvocate' => $caseRegistration->radvocate,
            'location' => $caseRegistration->location,
            'applicant' => $caseRegistration->applicant,
            'respondent' => $caseRegistration->respondent,
            'status' => $caseRegistration->status,
            'reopened' => $caseRegistration->reopened,
            'interim_judgements' => $interimJudgements,
        ];

        return response()->json($data);
    }


    public function ShowCasesType($casetype)
    {

        $data = CaseRegistration::where('case_type',  $casetype)->paginate(10);
        return response()->json($data);
    } // end mehtod

    public function ShowCasesAdvocate($advocate)
    {
        $data = CaseRegistration::where('padvocate', 'like', '%' . $advocate . '%')->orWhere('radvocate', 'like', '%' . $advocate . '%')->paginate(10);
        return response()->json($data);
    } // end mehtod

}
