<?php

// app/Http/Controllers/Utility/SqlUtilityController.php
namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller; // Correctly import the base Controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SqlUtilityController extends Controller
{
    public function index()
    {
        // Fetch SQL files from the directory
        $sqlFiles = File::files(public_path('sql_backup'));

        // Extract file names
        $fileNames = array_map(function ($file) {
            return $file->getFilename();
        }, $sqlFiles);

        return view('sql-utility.index', compact('fileNames'));
    }

    public function getTables()
    {
        // Fetch table names from the database
        $tables = DB::select('SHOW TABLES');
        $tableNames = array_map(function ($table) {
            return array_values((array)$table)[0];
        }, $tables);

        return response()->json($tableNames);
    }

    public function validateSql(Request $request)
    {
        $sqlFile = public_path('sql_backup/' . $request->input('sql_file'));
        $tableName = $request->input('table_name');

        // Extract columns from the SQL file
        $sqlContent = File::get($sqlFile);

        // Logging for debugging
        Log::debug('SQL Content loaded for table: ' . $tableName);

        // Refined pattern to match INSERT statements
        $pattern = '/INSERT INTO `' . $tableName . '`\s*\((.*?)\)\s*VALUES\s*\((.*?)\);/is';
        if (preg_match_all($pattern, $sqlContent, $matches)) {
            $insertStatements = $matches[0];
            Log::debug('Total INSERT statements found: ' . count($insertStatements));
        } else {
            Log::error('Failed to find INSERT statements for the specified table in the SQL file.');
            return back()->withErrors(['error' => 'Failed to find INSERT statements for the specified table in the SQL file.']);
        }

        // Extract columns from the selected table
        $tableColumns = DB::getSchemaBuilder()->getColumnListing($tableName);

        // Remove created_at and updated_at from table columns for comparison
        $tableColumns = array_diff($tableColumns, ['created_at', 'updated_at']);

        // Ensure table has columns other than created_at and updated_at
        if (empty($tableColumns)) {
            Log::error('The specified table does not have any columns apart from created_at and updated_at.');
            return back()->withErrors(['error' => 'The specified table does not have any columns apart from created_at and updated_at.']);
        }

        // Truncate the table
        DB::table($tableName)->truncate();

        // Initialize counters for processed and failed statements
        $processedCount = 0;
        $failedCount = 0;

        // Execute INSERT statements safely
        foreach ($insertStatements as $statement) {
            try {
                $adjustedStatement = $this->adjustInsertStatement($statement, $tableName, $tableColumns);
                DB::unprepared($adjustedStatement);
                $processedCount++;
            } catch (\Exception $e) {
                Log::error('Error executing statement: ' . $e->getMessage());
                Log::error('Failed statement: ' . $statement);
                $failedCount++;
            }
        }

        Log::info("Import completed. Processed: $processedCount, Failed: $failedCount");
        return back()->with('success', "Table data imported successfully. Processed: $processedCount, Failed: $failedCount");
    }

    private function adjustInsertStatement($statement, $tableName, $tableColumns)
    {
        // This function adjusts the INSERT statement to exclude columns that are no longer in the table
        $pattern = '/INSERT INTO `' . $tableName . '`\s*\((.*?)\)\s*VALUES\s*\((.*?)\);/is';
        if (preg_match($pattern, $statement, $matches)) {
            // Split columns and values correctly, considering possible commas within values
            $columns = $this->splitColumnsOrValues($matches[1]);
            $values = $this->splitColumnsOrValues($matches[2]);

            // Filter out columns and values that are not in the current table schema
            $filteredColumns = [];
            $filteredValues = [];
            foreach ($columns as $index => $column) {
                $column = trim($column, '` ');
                if (in_array($column, $tableColumns)) {
                    $filteredColumns[] = $columns[$index];
                    $filteredValues[] = $values[$index];
                }
            }

            $newColumns = implode(',', $filteredColumns);
            $newValues = implode(',', $filteredValues);

            // Create new adjusted INSERT statement
            return "INSERT INTO `$tableName` ($newColumns) VALUES ($newValues);";
        }

        return $statement; // Return original if pattern doesn't match
    }

    private function splitColumnsOrValues($str)
    {
        // This function splits columns or values correctly, considering possible commas within values
        $result = [];
        $current = '';
        $inQuotes = false;
        $quoteChar = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $char = $str[$i];
            if ($char == '\'' || $char == '"') {
                if ($inQuotes && $char == $quoteChar) {
                    $inQuotes = false;
                } else if (!$inQuotes) {
                    $inQuotes = true;
                    $quoteChar = $char;
                }
            }
            if ($char == ',' && !$inQuotes) {
                $result[] = $current;
                $current = '';
            } else {
                $current .= $char;
            }
        }
        $result[] = $current;
        return array_map('trim', $result);
    }

    private function getColumnsFromSql($sqlColumnsString)
    {
        $columns = [];
        foreach (explode(',', $sqlColumnsString) as $column) {
            preg_match('/`(.*?)`/', trim($column), $matches);
            if (isset($matches[1])) {
                $columns[] = $matches[1];
            }
        }
        return $columns;
    }
}
