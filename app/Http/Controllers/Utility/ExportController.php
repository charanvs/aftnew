<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\TableExportJudgement;
use App\Exports\GenericExport;

use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index() {
        return view('frontend.export.index');
    }
    public function exportToExcel()
    {
        return Excel::download(new TableExportJudgement, 'judgement.xlsx');
    }

    public function export(Request $request)
    {
        // Get the selected table from the form
        $table = $request->input('table');

        // Validate that the table is provided
        if (!$table) {
            return back()->withErrors(['error' => 'Please select a table to export']);
        }

        // Export the table to an Excel file
        return Excel::download(new GenericExport($table), $table . '.xlsx');
    }

    public function showExportForm()
{
    // Fetch the name of the database
    $dbName = env('DB_DATABASE');

    // Fetch all tables from the database
    $tables = \DB::select('SHOW TABLES');

    // Extract table names dynamically
    $tableNames = array_map(function($table) {
        // Convert the stdClass object to an array and get the first value (the table name)
        return array_values((array) $table)[0];
    }, $tables);

    // Return the view with the list of table names
    return view('frontend.export.export', ['tables' => $tableNames]);
}


}
