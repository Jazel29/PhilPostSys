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

        $data = [
            'D5' => $exportData['records']['mailTrackNum'] ?? '',
            'A5' => $exportData['records']['date'] ?? '',
            'A7' => strtoupper($exportData['records']['addresseePN'] ?? ''),
            'A8' => strtoupper($exportData['records']['addresseeSN'] ?? ''),
            'A9' => $exportData['records']['address'] ?? '',
            'A10' => $exportData['records']['zip'] . ' ' . $exportData['records']['city'] ?? '',
        ];

        // Set font attributes to make it bold for specific cells
        $boldCells = ['D5', 'A7', 'A8'];

        foreach ($data as $cell => $value) {
            $sheet->setCellValue($cell, $value);

            // Set font attributes to make it bold if the cell is in $boldCells array
            if (in_array($cell, $boldCells)) {
                $sheet->getStyle($cell)->getFont()->setBold(true);
            }
        }

        $rrtnLength = count($exportData['rrtn']);
        $startRow = 18;
        $startCol = 'A';
        $tnCount = 1;

        foreach ($exportData['rrtn'] as $index => $rrtn) {
            $row = $startRow + $index;
            $col = $startCol;
            $sheet->setCellValue($col . $row, $tnCount . '  .' . $rrtn);
            $tnCount++;
            $col++;
        }
        

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
        
        return response()->json(['success' => true, 'path' => $destinationPath]);
    }
}

