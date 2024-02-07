<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transmittal extends Model
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
