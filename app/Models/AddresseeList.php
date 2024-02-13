<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddresseeList extends Model
{
    use HasFactory;

    protected $addressee;
    protected $fillable=[   
        'abbrev',
        'name_primary',
        'name_secondary',
        'address',
        'city',
        'zip',
        'province'
    ];
}
