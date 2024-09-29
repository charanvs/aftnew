<?php

namespace App\Exports;

use App\Models\Judgement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class TableExportJudgement implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Judgement::all();
    }

        // Defining the headings for the exported columns
        public function headings(): array
        {
            return [
                'ID',          // Column headers
                'Registration No', 
                'Case Type',
                'File No',
                'Year',
                'Associated',
                'Date of Registration',
                'Department',
                'Department Code',
                'Subject',
                'Subject Code',
                'Petitioner',
                'Respondent',
                'Advocate - Applicant',
                'Advocate - Respondent',
                'Coram',
                'Court No',
                'Gno',
                'Appeal',
                'JRO',
                'Date Of Deciesion',
                'MOD',
                'PDF',
                'Remarks',
                'Head Notes',
                'Citation',
                'Location'

            ];
        }
    
}
