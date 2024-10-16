<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Judgement;
use App\Models\InterimJudgement;
use App\Models\Disposed;

use App\Models\JudgementOne;
use App\Models\JudgementTwo;
use App\Models\JudgementThree;

use Illuminate\Support\Facades\DB; // Import DB facade


class JudgementController extends Controller
{
    public function ShowJudgements2015()
    {

        $judgements2015 = JudgementOne::latest()->select('case_type', 'file_no', 'year', 'petitioner', 'mod', 'dod', 'padvocate', 'radvocate')->get();
        return view('frontend.judgement2015', compact('judgements2015'));
    } // end mehtod


    public function JudgementsSearch(Request $request)
    {
        $query = Judgement::query();
    
        // Apply filters based on the request parameters
        if ($request->has('fileno')) {
            $query->where('regno', 'LIKE', '%' . $request->fileno . '%');
        }
    
        if ($request->has('partyname')) {
            $query->where('petitioner', 'LIKE', '%' . $request->partyname . '%');
        }
    
        if ($request->has('advocate')) {
            $query->where(function ($query) use ($request) {
                $query->where('padvocate', 'LIKE', '%' . $request->advocate . '%')
                      ->orWhere('radvocate', 'LIKE', '%' . $request->advocate . '%');
            });
        }
    
        if ($request->has('casetype')) {
            $query->where('case_type', $request->casetype);
        }
    
        if ($request->has('casedate')) {
            $query->where('dod', $request->casedate);
        }
    
        if ($request->has('subject')) {
            $query->where('subject', 'LIKE', '%' . $request->subject . '%');
        }
    
        // Handle searching by judges and join with aft_corum table
        if ($request->has('judges')) {
            $query->where(function ($query) use ($request) {
                $query->where('corum', 'LIKE', $request->judges)
                      ->orWhere('corum', 'LIKE', $request->judges . ',%')
                      ->orWhere('corum', 'LIKE', '%,' . $request->judges . ',%')
                      ->orWhere('corum', 'LIKE', '%,' . $request->judges);
            });
        }
    
        // Fetch judgements with pagination
        $judgements = $query->paginate(5000); // You can adjust the pagination size as needed
    
        // Fetch all corum names based on the corum values
        foreach ($judgements as $judgement) {
            // Assume `corum` field contains IDs like "1,2" and explode it into an array
            $corumIds = explode(',', $judgement->corum);
    
            // Fetch corresponding corum names from aft_corum table using DB facade
            $corumNames = DB::table('aft_corum')
                ->whereIn('id', $corumIds)
                ->pluck('name')
                ->toArray();
    
            // Attach the corum names to the judgement object
            $judgement->corum_descriptions = implode(', ', $corumNames); // Join the names into a single string
        }
    
        // Return the updated judgements with corum descriptions
        return response()->json($judgements);
    }
    

    public function WildSearch()
    {
        $data = Judgement::all();
        
        return view('frontend.judgements.wild_search', compact('data'));
    } // end mehtod

    public function JudgementsSearchType($casetype)
    {

        $data = Judgement::where('case_type',  $casetype)->paginate(10);
        return response()->json($data);
    } // end mehtod


    public function JudgementsSearchAdvocate($advocate)
    {
        $data = Judgement::where('padvocate', 'like', '%' . $advocate . '%')->orWhere('radvocate', 'like', '%' . $advocate . '%')->paginate(10);
        return response()->json($data);
    } // end mehtod

    public function JudgementsSearchDate($casedate)
    {

        $data = Judgement::where('dod', '=',  $casedate)->paginate(10);
        // $query = Judgement::where('dod', $casedate);

        // dd($query->toSql(), $query->getBindings());

        return response()->json($data);
    } // end mehtod

    public function JudgementsSearchSubject($subject)
    {
        $data = Judgement::where('subject', 'like', '%' . $subject . '%')->paginate(10);
        return response()->json($data);
    } // end mehtod

    public function showPdf(Request $request)
    {
        // Retrieve the judgement from the database
        $data = Judgement::findOrFail($request->id);

        return response()->json($data);
    }

    public function ShowJudgementsData(Request $request)
    {

        $judgement = Judgement::findOrFail($request->id);
        $regnoJ = $judgement->regno;
        $rno = Disposed::where('regno', $regnoJ)->pluck('regid')->first();
        $interimJudgements = InterimJudgement::where('regid', $rno)->get(['dol', 'pdfname']);

        // Adjust this part according to your actual database structure
        $data = [
            'regno' => $judgement->regno,
            'year' => $judgement->year,
            'case_type' => $judgement->case_type,
            'deptt' => $judgement->deptt,
            'associated' => $judgement->associated,
            'dor' => $judgement->dor,
            'dod' => $judgement->dod,
            'padvocate' => $judgement->padvocate,
            'radvocate' => $judgement->radvocate,
            'subject' => $judgement->subject,
            'petitioner' => $judgement->petitioner,
            'respondent' => $judgement->respondent,
            'court_no' => $judgement->court_no,
            'remarks' => $judgement->remarks,
            'corum' => $judgement->corum,
            'dpdf' => $judgement->dpdf,
            'corum_descriptions' => $judgement->corum_descriptions,
            'pdfUrl' => route('judgements.pdf', $judgement->id),

            'interim_judgements' => $interimJudgements,
        ];

        return response()->json($data);
    }

    public function ShowJudgements()
    {
        return view('frontend.judgements.judgements');
    } // end mehtod

    public function ShowJudgements2020()
    {

        $judgements2020 = JudgementTwo::latest()->select('case_type', 'file_no', 'year', 'petitioner', 'mod', 'dod', 'padvocate', 'radvocate')->get();
        return view('frontend.judgement2020', compact('judgements2020'));
    } // end mehtod

    public function ShowJudgements2024()
    {

        $judgements2024 = JudgementThree::latest()->select('case_type', 'file_no', 'year', 'petitioner', 'mod', 'dod', 'padvocate', 'radvocate')->get();
        return view('frontend.judgement2024', compact('judgements2024'));
    } // end mehtod

    public function ReportableJudgements()
    {
        // $data = Judgement::where('reportable', '=', 'Y')->get();

        return view('frontend.judgements.reportable_judgements');
    }

    public function LargeBenchJudgements()
    {
        // $data = Judgement::where('larger_bench', '=', 'Y')->get();

        return view('frontend.judgements.largebench_judgements');
    }

    public function ReviewCases()
    {
        // $data = Judgement::where('larger_bench', '=', 'Y')->get();

        return view('frontend.judgements.review_cases');
    }

    public function getJudgesList(Request $request)
{
    $search = $request->input('search');
    $page = $request->input('page', 1);
    $limit = 10; // Number of items per page

    // Fetch judges from the database with pagination
    $query = DB::table('aft_corum')
        ->where('name', 'like', "%$search%")
        ->paginate($limit, ['*'], 'page', $page);

    $results = $query->items();
    $morePages = $query->hasMorePages();

    return response()->json([
        'items' => $results,
        'pagination' => [
            'more' => $morePages
        ]
    ]);
}

}
