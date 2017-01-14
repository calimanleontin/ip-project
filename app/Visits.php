<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Companies');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
