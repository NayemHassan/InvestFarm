<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignSaleAmount extends Model
{
    //
    protected $guarded = [];
    public function sales(){
        return $this->belongsTo(Sales::class,'sale_id','id');
    }
    public function member(){
        return $this->belongsTo(Member::class);
    }
}
