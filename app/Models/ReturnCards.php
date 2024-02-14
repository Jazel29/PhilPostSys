<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnCards extends Model
{
    use HasFactory;
    protected $return_cards;
    protected $fillable=[
        'returncard',
        'trucknumber'
    ]; 

    public function transmittals(){
        return $this->belongsTo(Transmittals::class);
    }
}
