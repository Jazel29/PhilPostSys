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
        $query = Transmittals::query();
        if ($request->has('search')) {
            $searchTerm = $request->search;
    
            $query->where('mailTrackNum', 'like', '%' . $searchTerm . '%')
                ->orWhere('recieverName', 'like', '%' . $searchTerm. '%')
                ->orWhere('recieverAddress', 'like', '%' . $searchTerm . '%');
        }
        $records = $query->paginate(8);
        return view('tracer', compact('records'));
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
    
}
