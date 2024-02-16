<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExcelExportController extends Controller
{
    public function exportToExcel(Request $request)
    {
        $exportData = json_decode($request->input('exportData'), true);

        // Load the existing spreadsheet (assuming format.xlsx is your template)
        $spreadsheet = IOFactory::load(public_path('assets/format.xlsx'));

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('D5', $exportData['records']['mailTrackNum'] ?? '');
        $sheet->setCellValue('A5', $exportData['records']['date'] ?? '');
        $sheet->setCellValue('A7', strtoupper($exportData['records']['addresseePN'] ?? ''));
        $sheet->setCellValue('A8', strtoupper($exportData['records']['addresseeSN'] ?? ''));
        $sheet->setCellValue('A9', $exportData['records']['address'] ?? '');
        $sheet->setCellValue('A10', $exportData['records']['zip'] . ' ' . $exportData['records']['city'] ?? '');

        $style = $sheet->getStyle('D5');
        $style = $sheet->getStyle('A7');
        $style = $sheet->getStyle('A8');

        // Set font attributes to make it bold
        $style->getFont()->setBold(true);

        // Specify the directory path on local disk D
        $directoryPath = 'C:\Users\Public\tracer_exports';

        // Create the directory if it doesn't exist
        if (!file_exists($directoryPath) && !is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        // Save the updated spreadsheet to the new directory
        date_default_timezone_set('Asia/Tokyo');
        $destinationPath = $directoryPath . '/tracer_' . date('Y_m_d_G-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($destinationPath);

        // Return a response or perform any other actions as needed
    }
}

