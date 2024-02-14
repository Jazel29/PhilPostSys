<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransmittalsController extends Controller
{
    public function index(){
        return view('transmittals');
    }

    public function tracerForm(){
        return view('transmittals');
    }
}
