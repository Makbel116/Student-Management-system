<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Batch;
use App\Models\Student;

use Barryvdh\DomPDF\PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PDFController extends Controller
{
    //



    public function generatePDF(Batch $batch, Request $request)
    {
        $students = $batch->students;
        $students = $batch->students;
        
        $zip = new ZipArchive();
        $zipFileName = 'documents.zip';
        $zipFilePath = storage_path('app/' . $zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($students as $student) {
                if ($request->has('email')) {

                    try {

                        MailController::send_completion_mail($student, $batch);
                        
                    } catch (Exception $e) {

                        report($e); // Log the error for troubleshooting
                        // dd($e);


                        return redirect()->back()->with("error", $e->getMessage());
                    }
                }
                if ($student->remaining_payment === null) {
                    $data = ['title' => $student->name, 'course' => $batch->course->name];
                    $pdf = app(PDF::class);
                    $pdf->setPaper('A4', 'landscape');
                    $pdf->loadView('Pdf.document', $data);
                    $pdfContent = $pdf->output();
                    $pdfFileName = 'document_' . $student->id . '.pdf';
                    $zip->addFromString($pdfFileName, $pdfContent);
                }
            }

            $zip->close();

            return response()->download($zipFilePath)->deleteFileAfterSend();
        }


        return redirect("/")->with("error", "downloaded was unsuccessfull try again!!!");
    }
}
