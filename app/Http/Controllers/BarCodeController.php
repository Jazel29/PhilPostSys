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
        $request->validate([
            'trackingNum' => 'required|unique:return_cards,returncard'
        ]);
    
        try {
            ReturnCards::create([
                'returncard' => $request->input('trackingNum'),
                'trucknumber' => $request->input('truckNumMail')
            ]);
    
            return redirect()->back()->with('success', 'Return card added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding return card: ' . $e->getMessage());
        }
    }

    public function show(){
        $returncards = ReturnCards::all();
    
        return view('return_cards.index', compact('returncards'));
    }

    public function update(){

    }

    public function destroy($id)
    {
        $returnCard = ReturnCards::findOrFail($id);
        $returnCard->delete();

        return redirect()->back()->with('success', 'Return card deleted successfully.');
    }
}
