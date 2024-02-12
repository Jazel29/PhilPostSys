<?php

namespace App\Http\Controllers;
use App\Models\Barcode;
use App\Models\ReturnCards;
use Illuminate\Http\Request;

class BarCodeController extends Controller
{
    public function index(){
        return view('tracer');
    }

    public function formTest(){
        return view('barcode.test-store');
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

    public function addReturnCard(Request $request){
        ReturnCards::create([
            'returncard' => $request->input('trackingNum'),
            'trucknumber' => $request->input('truckNumMail')
        ]);
        return response()->json([
            'redirect' => '/barcode',
            'flash_mssg' => 'Successfully Created!'
        ]);
    }
}
