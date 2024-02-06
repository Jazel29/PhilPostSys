<?php

namespace App\Http\Controllers;
use App\Models\Barcode;
use Illuminate\Http\Request;

class BarCodeController extends Controller
{
    public function index(){
        return view('barcode.store');
    }

    public function store(Request $request){

        $request->validate([
            'barcode' => 'required|unique:barcodes,barcode' // Ensure barcode is required and unique in the 'barcodes' table
        ]);

        Barcode::create([
            'barcode'=> $request->input('barcode')
        ]);
        return redirect('/barcode')->with('flash_mssg', 'Successfully Created!');
    }
}
