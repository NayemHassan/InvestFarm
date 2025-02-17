<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    public function investments(){
        return $this->belongsTo(Investments::class,'investment_id','id');
    }
}
