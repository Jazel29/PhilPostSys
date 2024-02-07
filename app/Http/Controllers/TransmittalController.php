<?php

namespace App\Http\Controllers;

use App\Models\Transmittal;
use App\Models\Transmittals;
use Illuminate\Http\Request;

class TransmittalController extends Controller
{
    public function index(){
        return view('barcode.test-store');
    }

    public function store(Request $request){
        // $request->validate([
        //     'mailTrackNum' => 'required|unique:mailTrackNums,mailTrackNum' // Ensure barcode is required and unique in the 'barcodes' table
        // ]);
        
            Transmittals::create([
                'mailTrackNum' => $request->input('tracknum'),
                'recieverName' => $request->input('recieverName'),
                'recieverAddress' => $request->input('recieverAddress'),
                'date' => $request->input('date')
            ]);
            return response()->json(['message' => 'Transmittal Created Successfully'], 200);
      
    }
}
