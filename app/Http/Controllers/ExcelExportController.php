<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;

class ExcelExportController extends Controller
{
    public function exportToExcel(Request $request)
    {
        $exportData = json_decode($request -> input('exportData'), true);
        // Load the existing spreadsheet (assuming format.xlsx is your template)
        $spreadsheet = IOFactory::load(public_path('assets/format.xlsx'));

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        $mailTrackNum = $exportData['records']['mailTrackNum'] ?? '';
        $date = $exportData['records']['date'] ?? '';
        $recieverName = $exportData['records']['recieverName'] ?? '';
        $recieverAddress = $exportData['records']['recieverAddress'] ?? '';

        // Set values in the specified cells
        $sheet->setCellValue('D5', $mailTrackNum);
        $sheet->setCellValue('A5', $date);
        $sheet->setCellValue('A7', $recieverName);
        $sheet->setCellValue('A8', ''); // Leave cell A8 blank
        $sheet->setCellValue('A10', $recieverAddress);

        // Save the updated spreadsheet back to the same file
        $filename = 'tracer_' . date('Ymd') . '.xlsx';

        // Get the absolute path to the public directory
        $publicPath = public_path();

        // Create the writer and save the Excel spreadsheet
        $writer = new Xlsx($spreadsheet);
        $writer->save($publicPath . '/' . $filename);
    }
}
