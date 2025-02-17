<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnAmount extends Model
{
    //
    protected $guarded = [];
    public function sales(){
        return $this->belongsTo(Sales::class,'sale_id','id');
    }
}
