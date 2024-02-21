<?php

namespace App\Http\Controllers;

use App\Models\ReturnCards;
use App\Models\Transmittals;
use App\Models\AddresseeList;
use Illuminate\Http\Request;
use Illuminate\View\View;


class TransmittalController extends Controller
{
    public function index(Request $request): View
    {
        $query = Transmittals::query()->get();
        $rrt_n = [];
        $addressees = [];
    
        foreach ($query as $record) {
            // Retrieve ReturnCards related to the current Transmittal's mailTrackNum
            $returnCards = ReturnCards::where('trucknumber', $record->mailTrackNum)->get();
            
            // Retrieve AddresseeList related to the current Transmittal's recieverName
            $addressee = AddresseeList::find($record->recieverName);
    
            // Add the ReturnCards to the array
            $rrt_n[$record->id] = $returnCards;
    
            // Add the AddresseeList to the array
            $addressees[$record->id] = $addressee;
        }
    
        return view('tracer', compact('query', 'rrt_n', 'addressees'));
    }
    

    public function store(Request $request) {
        $existingTransmittal = Transmittals::where('mailTrackNum', $request->input('mail_tn'))->first();

        if ($existingTransmittal) {
            // Handle the case where mailTrackNum already exists
            return redirect('/add_transmittal')
                ->with('flash_mssg', 'Mail Track Number already exists!')
                ->withInput($request->all()); // Retain all input values
        }
    
        // Create a new Transmittals record
        $transmittal = Transmittals::create([
            'mailTrackNum' => $request->input('mail_tn'),
            'recieverName' => $request->input('receiver'),
            'recieverAddress' => $request->input('address'),
            'date' => $request->input('date_posted')
        ]);

        // Redirect back to the tracer page with a success message
        return redirect('/tracer')->with('flash_mssg', 'Successfully Created!');
    } catch (\Exception $e) {
        // If an exception occurs during the creation process, redirect back with an error message
        return redirect()->back()->with('error', 'Error updating transmittal: ' . $e->getMessage());
    }
}

    // fetch to the bladev views
    public function show($mailTrackNum){
        $record = Transmittals::find($mailTrackNum);
        $rrr_tn = ReturnCards::where('trucknumber', $record->mailTrackNum)->get();
        $addressee = AddresseeList::find($record->recieverName);
        if (!$record) { 
            abort(404);
        }
        
        return view('transmittals', compact('mailTrackNum'))->with(['records' => $record, 'rrt_n' =>$rrr_tn, 'addressee' => $addressee]);
        
    }

    public function checkMailTN(Request $request)
    {
        $mail_tn = $request->input('mail_tn');

        $existingTransmittal = Transmittals::where('mailTrackNum', $mail_tn)->exists();

        return response()->json(['exists' => $existingTransmittal]);
    }

    

    public function edit($id){  
        $records = Transmittals::find($id);
        $addressee = AddresseeList::find($records->recieverName);
        if (!$records) {
            return redirect()->route('/transmittals')->with('flash_message', 'Member not found');
        }
        return view('edit-transmitttals', ['records' => $records, 'addressee' => $addressee]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all()); // Inspect the data received by the controller
        try {
            $record = Transmittals::findOrFail($id);
    
            $input = $request->all();
    
            $record->update($input);
    
            return redirect('tracer')->with('flash_mssg', 'message!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating transmittal: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Transmittals::destroy($id);
        return redirect('tracer')->with('flash_mssg', 'Record Deleted Successfully!');  
    }
    
    public function deleteReturnCard($id){
        ReturnCards::destroy($id);
        return redirect()->back()->with('flash_mssg', 'Record Deleted Successfully! this');
    }
}
