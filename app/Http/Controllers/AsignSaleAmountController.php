<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Sales;
class AsignSaleAmountController extends Controller
{
    public function index(){
        $members = Member::all();
        $sales = Sales::all();
        return view('backend.pages.asign-sale-amount.asign-sale-amount',compact('members','sales'));
    }
}
