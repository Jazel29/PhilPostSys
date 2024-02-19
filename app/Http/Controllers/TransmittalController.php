<?php

namespace App\Http\Controllers;

use App\Models\ReturnCards;
use App\Models\Transmittals;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransmittalController extends Controller
{
    public function index(Request $request): View
    {
        $query = Transmittals::query()->get();
        $rrt_n = [];

        foreach ($query as $record) {
            // Retrieve ReturnCards related to the current Transmittal's mailTrackNum
            $returnCards = ReturnCards::where('trucknumber', $record->mailTrackNum)->get();
            
            // Add the ReturnCards to the array
            $rrt_n[$record->id] = $returnCards;
        }

        return view('tracer', compact('query', 'rrt_n'));
    }

    public function store(Request $request){
        // $request->validate([
        //     'mailTrackNum' => 'required|unique:mailTrackNums,mailTrackNum' // Ensure barcode is required and unique in the 'barcodes' table
        // ]);
        
            Transmittals::create([
                'mailTrackNum' => $request->input('mail_tn'),
                'recieverName' => $request->input('receiver'),
                'recieverAddress' => $request->input('address'),
                'date' => $request->input('date_posted')
            ]);
            // ReturnCards::create([
            //     'returncard' => $request->input('mail_tn'),
            //     'trucknumber' => $request->input('rrr_tn')
            // ]);
            return redirect('/add_transmittal')->with('flash_mssg', 'Successfully Created!');
      
    }

    // fetch to the bladev views
    public function show($mailTrackNum){
        $record = Transmittals::find($mailTrackNum);
        $rrr_tn = ReturnCards::where('trucknumber', $record->mailTrackNum)->get();
        if (!$record) { 
            abort(404);
        }
        return view('transmittals', compact('mailTrackNum'))->with(['records' => $record, 'rrt_n' =>$rrr_tn]);
    }

    public function edit($id){  
        $records = Transmittals::find($id);
        if (!$records) {
            return redirect()->route('/transmittals')->with('flash_message', 'Member not found');
        }
        return view('edit-transmitttals', compact('records'));
    }
    public function update(Request $request, $id)
    {
        try {
            $record = Transmittals::findOrFail($id);

            $input = $request->all();

            $record->update($input);

            return redirect('tracer')->with('success_edit', 'Transmittal Edited Successful!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating transmittal: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        Transmittals::destroy($id);
        return redirect('tracer')->with('flash_mssg', 'Youth Info Deleted!');  
    }
}
