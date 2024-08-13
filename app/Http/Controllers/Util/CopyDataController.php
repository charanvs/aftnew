<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

class CopyDataController extends Controller
{
    public function index()
    {
        return view('backend.util.data_copy');
    }

    public function copyJudgements(Request $request)
    {
        try {
            DB::transaction(function () {
                // Truncate the 'judgements' table
                DB::statement('TRUNCATE TABLE judgements');

                // Copy data from 'aft_judgement' table to 'judgements' table
                DB::statement('INSERT INTO judgements (
                id,
                regno,
                case_type,
                file_no,
                year,
                associated,
                dor,
                deptt,
                deptt_code,
                subject,
                subject_code,
                petitioner,
                respondent,
                padvocate,
                radvocate,
                corum,
                court_no,
                gno,
                appeal,
                jro,
                dod,
                `mod`,
                dpdf,
                remarks,
                headnotes,
                citation,
                location
            )
            SELECT
                id,
                regno,
                case_type,
                file_no,
                year,
                associated,
                dor,
                deptt,
                deptt_code,
                subject,
                subject_code,
                petitioner,
                respondent,
                padvocate,
                radvocate,
                corum,
                court_no,
                gno,
                appeal,
                jro,
                dod,
                `mod`,
                dpdf,
                remarks,
                headnotes,
                citation,
                location
            FROM aft_judgement');
            });

            return response()->json(['message' => 'Data copied successfully from aft_judgement to judgements.']);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error copying data: ' . $e->getMessage());

            return response()->json(['message' => 'An error occurred while copying the data.'], 500);
        }
    }

    public function copyTableData(Request $request)
    {
        $sourceTable = $request->input('source_table');
        $destinationTable = $request->input('destination_table');
        // dd($sourceTable, $destinationTable);

        try {
            // Check if both tables exist
            if (!Schema::hasTable($sourceTable) || !Schema::hasTable($destinationTable)) {
                throw new \Exception("One or both tables do not exist.");
            }

            // Get the columns of both tables to ensure they are similar
            $sourceColumns = Schema::getColumnListing($sourceTable);
            $destinationColumns = Schema::getColumnListing($destinationTable);

            // Ignore created_at and updated_at columns for comparison
            $destinationColumns = array_diff($destinationColumns, ['created_at', 'updated_at']);

            // Check if both tables have the same structure (excluding created_at, updated_at)
            if ($sourceColumns !== $destinationColumns) {
                throw new \Exception("The columns in the source and destination tables do not match.");
            }

            // Escape columns with reserved words
            $escapedColumns = array_map(function ($column) {
                return "`$column`";
            }, $sourceColumns);

            // Truncate the destination table
            DB::statement("TRUNCATE TABLE $destinationTable");

            // Create the SQL for copying data, including handling of created_at and updated_at
            $columnsList = implode(', ', $escapedColumns);
            $columnsListWithTimestamps = $columnsList . ', NOW() AS `created_at`, NOW() AS `updated_at`';

            DB::statement("INSERT INTO $destinationTable ($columnsList, `created_at`, `updated_at`)
                SELECT $columnsListWithTimestamps FROM $sourceTable");

            $notification = array(
                'message' => 'Copy data from ' . $sourceTable . ' to ' . $destinationTable . " Successfully",
                'alert-type' => 'success'
            );

            return redirect()->route('copy.data')->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => "Error in copying",
                'alert-type' => 'danger'
            );
            return redirect()->route('copy.data')->with($notification);
        }
    }

    public function importIndex()
    {
        return view('backend.util.import_data');
    }
    public function importData(Request $request)
    {
        // $request->validate([
        //     'sql_file' => 'required|mimes:sql',
        // ]);

        // Handle the uploaded file
        $file = $request->file('sql_file');
        $filePath = $file->getRealPath();

        // dd($file);

        // Read the file content
        $sqlContent = File::get($filePath);

        try {
            // Execute the SQL queries
            DB::unprepared($sqlContent);

            $notification = array(
                'message' => 'Import data Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('import.data')->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => "Error in Importing data.",
                'alert-type' => 'danger'
            );
            return redirect()->route('import.data')->with($notification);
        }
    }
}
