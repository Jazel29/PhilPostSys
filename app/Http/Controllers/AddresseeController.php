<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddresseeList;
use Illuminate\Validation\ValidationException;

class AddresseeController extends Controller
{
    public function showIndex()
    {
        return view('new-addressee');
    }

    public function showUpdateAddressee()
    {
        return view('update-addressee');
    }

    public function storeAddressee(Request $request)
    {
        try {
            $request->validate([
                'nameAbbrev' => 'required',
                'namePrimary' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'province' => 'required',
            ]);

            AddresseeList::create([
                'abbrev' => $request->input('nameAbbrev'),
                'name_primary' => $request->input('namePrimary'),
                'name_secondary' => $request->input('nameSecondary'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'zip' => $request->input('zip'),
                'province' => $request->input('province')
            ]);

            return redirect()->back()->with('status', 'Addressee Added Successfully');
        } catch (ValidationException $e) {
            // If validation fails, redirect back with errors and input data
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function getAddressees()
    {
        $addressees = AddresseeList::select('*')->get();
        return response()->json(['addressees' => $addressees], 200);
    }

    public function updateAddressee(Request $request)
    {
        try {
            $request->validate([
                'nameAbbrev' => 'required',
                'namePrimary' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'province' => 'required',
            ]);

            // Find the addressee based on the provided $id
            $addressee = AddresseeList::find($request->input('addressee-id'));

            if (!$addressee) {
                // Handle the case where the addressee is not found (you may want to show an error message or redirect)
                return redirect()->back()->with('error', 'Addressee not found');
            }

            // Update the addressee's information
            $addressee->update([
                'abbrev' => $request->input('nameAbbrev'),
                'name_primary' => $request->input('namePrimary'),
                'name_secondary' => $request->input('nameSecondary'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'zip' => $request->input('zip'),
                'province' => $request->input('province')
            ]);

            return redirect('update-addressee-form')->with('status', 'Addressee Updated Successfully');
        } catch (ValidationException $e) {
            // If validation fails, redirect back with errors and input data
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function showAddresseeList(){
        $addresseeAll = AddresseeList::select('*')->get();

        return view('addressee.show-addressee')->with(['addresseeAll'=>$addresseeAll]);
    }
    
    public function destroy($id)
    {
        AddresseeList::destroy($id);
        return redirect('show-addressee')->with('flash_mssg', 'Record Deleted Successfully!');  
    }
}

