<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CasePdf;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Corum;
use App\Models\CaseRegistration;

class CaseController extends Controller
{
    public function index()
    {
        $cases = CasePdf::all();
        return view('cases.index', compact('cases'));
    }

    public function create()
    {
        $corums = Corum::where('published', 2)->get();
        return view('cases.create', compact('corums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'case_number' => 'required',
            'petitioner' => 'required',
            'respondent' => 'required',
            'petitioner_advocate' => 'required',
            'respondent_advocate' => 'required',
            'date' => 'required|date',
            'type' => 'required',
            'corum_id' => 'required|array',
            'corum_id.*' => 'exists:corums,id',
            'published' => 'required|integer',
        ]);

        $case = CasePdf::create($request->except('corum_id'));
        $case->corums()->sync($request->corum_id);

        return redirect()->route('cases.index')->with('success', 'Case added successfully');
    }

    public function generatePDF()
    {
        $date = "2024-06-13";

        // Fetch the cases with the specified date
        $cases = CasePdf::where('date', $date)->get();

        // Check if there are any cases for the specified date
        if ($cases->isEmpty()) {
            return redirect()->route('cases.index')->with('error', 'No cases found for the specified date.');
        }

        // Share data to the view
        $data = ['cases' => $cases, 'date' => $date];

        // Load the view and pass the data
        $pdf = PDF::loadView('cases.pdfgen', $data);

        // Return the generated PDF
        return $pdf->download('cases-' . $date . '.pdf');
    }


    public function caseSearch(Request $request)
    {
        $query = $request->get('query', '');
        $cases = CaseRegistration::where('registration_no', 'LIKE', "%{$query}%")
            ->orWhere('applicant', 'LIKE', "%{$query}%")
            ->orWhere('respondent', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        return response()->json($cases);
    }
}
