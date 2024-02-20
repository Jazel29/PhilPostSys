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
        return view('barcode.store');
    }

    public function store(Request $request){

        $request->validate([
            'barcode' => 'required|unique:barcodes,barcode' // Ensure barcode is required and unique in the 'barcodes' table
        ]);

        Barcode::create([
            'barcode'=> $request->input('barcode')
        ]);
        return redirect('/tracer')->with('flash_mssg', 'Successfully Created!');
    }

    public function addReturnCard(Request $request){
        ReturnCards::create([
            'returncard' => $request->input('trackingNum'),
            'trucknumber' => $request->input('truckNumMail')
        ]);
        
    }
    public function update(){

    }

    public function destroy($id){
        ReturnCards::destroy($id);
        return redirect('tracer')->with('flash_mssg', 'Record Deleted Successfully!'); 
    }
}
