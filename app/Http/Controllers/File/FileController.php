<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    public function standardizeFilenames()
    {
        $folderPath = public_path('path_to_your_folder'); // Path to your folder containing the files

        // Fetch filenames from the database
        $files = DB::table('your_table_name')->select('id', 'dpdf')->get();

        foreach ($files as $file) {
            $id = $file->id;
            $originalFilename = $file->dpdf;
            $standardizedFilename = str_replace(" ", "_", $originalFilename);

            // Rename the file in the filesystem
            $originalFilePath = $folderPath . DIRECTORY_SEPARATOR . $originalFilename;
            $standardizedFilePath = $folderPath . DIRECTORY_SEPARATOR . $standardizedFilename;

            if (File::exists($originalFilePath)) {
                if (File::move($originalFilePath, $standardizedFilePath)) {
                    echo "File renamed successfully: $originalFilePath -> $standardizedFilePath<br>";

                    // Update the filename in the database
                    DB::table('your_table_name')
                        ->where('id', $id)
                        ->update(['dpdf' => $standardizedFilename]);

                    echo "Database updated successfully for ID $id<br>";
                } else {
                    echo "Error renaming file: $originalFilePath<br>";
                }
            } else {
                echo "File does not exist: $originalFilePath<br>";
            }
        }
    }
    public function FileNameChange()
    {
        return view('Files.standardize_filenames');
    }
}
