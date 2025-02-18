<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\ReturnAmount;
use Carbon\Carbon;
use App\Models\Transactions;
use App\Models\Investments;
use App\Models\Profit;
use App\Models\Balance;
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
      Transactions::create([
            'type' => 'Collection Amount',
            'sale_id' => $request->sale_id,
            'amount' => $request->amount,
            'date' => Carbon::now(),
            'details' => 'Collection Amount Collected',
        ]);
        $balance = Balance::first(); // প্রথম ব্যালান্স রেকর্ড খুঁজবে
       
        if ($balance) {
            $balance->total_balance += $request->amount;
            $balance->save();
        } else {
            // যদি Balance টেবিলে কোনো এন্ট্রি না থাকে, তাহলে নতুন এন্ট্রি তৈরি করবে
            Balance::create([
                'total_balance' => $request->amount,
            ]);
        }
        $sale = Sales::findOrFail($request->sale_id);
        if ($sale) {
            $investment = Investments::find($sale->investment_id);
            if ($investment) {
                $totalReturnAmount = ReturnAmount::where('sale_id', $request->sale_id)->sum('amount'); // মোট ফেরত আসা টাকা
                
                // ✅ এই sale_id এর জন্য আগের profit বের করা
                $previousProfit = Profit::where('sale_id', $request->sale_id)->sum('amount') ?? 0;
        
                // ✅ নতুন profit ক্যালকুলেট করা
                $newProfit = max(0, $totalReturnAmount - $investment->amount);
        
                // ✅ পার্থক্য বের করা (শুধু নতুন অংশ যোগ হবে)
                $profitDifference = max(0, $newProfit - $previousProfit);
        
                // ✅ Balance টেবিলে আপডেট
                $balance->total_balance += 0; 
                $balance->total_profit += $profitDifference; 
                $balance->save();
        
                // ✅ Profit table-এ আপডেট (যাতে পরবর্তীতে আগের profit হিসাব করা যায়)
                Profit::updateOrCreate(
                    ['sale_id' => $request->sale_id], // যদি sale_id এক্সিস্ট করে, তাহলে আপডেট করবে
                    ['amount' => $newProfit] // নতুন profit সেট করবে
                );
            }
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
