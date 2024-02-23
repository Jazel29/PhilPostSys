<?php

namespace App\Http\Controllers;
use App\Models\Transmittals;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $transmittalsTotal = Transmittals::count();
        return view('dashboard')->with(['totalTransmittals'=>$transmittalsTotal]);
    }
}
