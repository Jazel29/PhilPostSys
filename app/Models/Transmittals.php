<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transmittals extends Model
{
    use HasFactory;
    protected $transmittal;
    protected $fillable=[
        'mailTrackNum',
        'recieverName',
        'recieverAddress',
        'date'
    ];

    
}
