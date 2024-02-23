<?php

namespace App\Http\Controllers;
use App\Models\Transmittals;
use App\Models\AddresseeList;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        //this is used for total number of rows which reflect as the number of transmittals
        $transmittalsTotal = Transmittals::count();

        // Retrieve all dates from the Transmittals model
        $dates = Transmittals::pluck('date');
        // Count the occurrences of each date
        $dateCounts = $dates->countBy();
        // Find the date with the highest occurrence count
        $mostUsedDateCount = $dateCounts->max();
        // Find the most frequently used date
        $mostUsedDate = $dateCounts->search($mostUsedDateCount);

        // Retrieve the total number of addressees
        $addresseesTotal = AddresseeList::count();

        // Retrieve all abbreviations from the AddresseeList model
        $abbreviations = AddresseeList::pluck('abbrev');

        // Count the occurrences of each abbreviation
        $abbreviationCounts = $abbreviations->countBy();

        // Find the abbreviation with the highest occurrence count
        $mostUsedAbbreviationCount = $abbreviationCounts->max();

        // Find the most frequently used abbreviation
        $mostUsedAbbreviation = $abbreviationCounts->search($mostUsedAbbreviationCount);

        return view('dashboard')->with(['totalTransmittals'=>$transmittalsTotal, 'freqDate' => $mostUsedDate, 'tolNo'=>$mostUsedDateCount, 'totalAddressees' => $addresseesTotal,
        'mostUsedAbbreviation' => $mostUsedAbbreviation,
        'mostUsedAbbreviationCount' => $mostUsedAbbreviationCount]);
    }

}
