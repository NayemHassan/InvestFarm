<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\ReturnAmount;
use Carbon\Carbon;
class ReturnAmountsController extends Controller
{
    public function index(){
        $sales = Sales::with('investments')->get();
        return view('backend.pages.retun_amounts.retun-amounts',compact('sales'));
    }
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'sale_id' => 'required',
            'date' => 'required',
            'amount' => 'required|numeric|min:1',
        ]);
    
        // Format the date
        $formattedDate = Carbon::parse($request->date)->format('Y-m-d');
    
        // Check if the sale_id exists
        $returnAmount = ReturnAmount::where('sale_id', $request->sale_id)->first();
    
        if ($returnAmount) {
            // If the sale_id exists, add the new amount to the existing amount
            $returnAmount->amount += $request->amount;
            $returnAmount->date = $formattedDate; // Update the date
            $returnAmount->save();
        } else {
            // If the sale_id does not exist, create a new record
            ReturnAmount::create([
                'sale_id' => $request->sale_id,
                'date' => $formattedDate,
                'amount' => $request->amount
            ]);
        }
    
        // Set notification message
        $notification = array(
            'message' => 'Collection of $' . $request->amount . ' was successfully added.',
            'alert-type' => 'info'
        );
    
        // Return with notification
        return redirect()->route('return.amounts.view')->with($notification);
    }
    
        public function view(){
            $returnAmounts = ReturnAmount::with(['sales.investments'])->latest()->get();
            return view('backend.pages.retun_amounts.view-retun-amounts', compact('returnAmounts'));
        }
       


}
