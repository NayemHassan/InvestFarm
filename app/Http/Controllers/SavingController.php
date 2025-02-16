<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
class SavingController extends Controller
{
    public function index(){
        $members =  Member::all();
        return view('backend.pages.savings.savings',compact('members'));
    }
}
