<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddresseeList;

class AddresseeController extends Controller
{
    public function store(Request $request){
        // $request->validate([
        //     'mailTrackNum' => 'required|unique:mailTrackNums,mailTrackNum' // Ensure barcode is required and unique in the 'barcodes' table
        // ]);
        
            AddresseeList::create([
                'abbrev'            => $request->input('nameAbbrev'),
                'name_primary'      => $request->input('namePrimary'),
                'name_secondary'    => $request->input('nameSecondary'),
                'address'           => $request->input('address'),
                'city'              => $request->input('city'),
                'zip'               => $request->input('zip'),
                'province'          => $request->input('province')
            ]);
            return redirect('add_transmittal')->with('record_added','Addressee Added Successfully'); 
      
    }

    public function getAddressees()
    {
        $addressees = AddresseeList::select('*')->get();

        return response()->json(['addressees' => $addressees], 200);
    }
}
