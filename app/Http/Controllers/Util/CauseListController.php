<?php

namespace App\Http\Controllers\util;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CauseListController extends Controller
{
    public function extractDataFromPdf($pdfPath)
    {
        // Extract text from the PDF
        $pdfText = Pdf::getText($pdfPath);
        
        // Use regex to extract the necessary case details
        // Example regex (adjust based on your cause list format)
        preg_match_all('/(OA \d+\/\d+)\s+(.+?)\s+V\/s\s+UOI & Ors\s+(.+?)\/\s+(.+?)\s/', $pdfText, $matches);
        
        $cases = [];
        foreach ($matches[0] as $index => $match) {
            $cases[] = [
                'case_number' => $matches[1][$index],
                'applicant' => $matches[2][$index],
                'padvocate' => $matches[3][$index],
                'radvocate' => $matches[4][$index],
            ];
        }

        return $cases;  // This will return an array of cases with the extracted data
    }

}
