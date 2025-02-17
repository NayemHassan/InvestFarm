<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
class Savings extends Model
{
    //
    protected $guarded = [];
    public function member(){
        return $this->belongsTo(Member::class,'member_id','id');
    }
}
