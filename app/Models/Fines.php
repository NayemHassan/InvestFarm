<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fines extends Model
{
    //
    protected $guarded = [];
    public function member(){
        return $this->belongsTo(Member::class,'member_id','id');
    }
}
