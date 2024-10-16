<?php
use PhpOffice\PhpWord\TemplateProcessor;

class TemplateService
{
    public function populateTemplate($templatePath, $caseData)
    {
        // Load the Word template
        $templateProcessor = new TemplateProcessor($templatePath);

        // Replace placeholders in the template with actual data
        $templateProcessor->setValue('Srlno', $caseData['srlno']);
        $templateProcessor->setValue('Case', $caseData['case_number']);
        $templateProcessor->setValue('Applicant', $caseData['applicant']);
        $templateProcessor->setValue('Padvocate', $caseData['padvocate']);
        $templateProcessor->setValue('Radvocate', $caseData['radvocate']);
        $templateProcessor->setValue('Date', date('d-m-Y'));  // Example date
        

        // Define the output path (in the storage directory)
        $outputPath = public_path('phpoffice/Populated_Court2_Template.docx');
        
        // Save the document to the specified path
        $templateProcessor->saveAs($outputPath);

        return $outputPath;
    }
}
