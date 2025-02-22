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
use App\Models\AsignSaleAmount;
class ReturnAmountsController extends Controller
{
    public function index(){
        $sales = Sales::with('investments')->get();
        $assignMembers = AsignSaleAmount::latest()->get();
        return view('backend.pages.retun_amounts.retun-amounts',compact('sales','assignMembers'));
    }
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'sale_id' => 'required',
            'date' => 'required',
            'amount' => 'required|numeric|min:1',
            'member_id' => 'required',
        ]);
    
        // Format the date
        $formattedDate = Carbon::parse($request->date)->format('Y-m-d');

        if ($request->member_id == 'nagad') {
            $assignSale = AsignSaleAmount::where('sale_id', $request->sale_id)
                                 ->whereIn('member_id', ['nagad'])
                                 ->first();
        } elseif($request->member_id == 'others'){
            $assignSale = AsignSaleAmount::where('sale_id', $request->sale_id)
            ->whereIn('member_id', ['others'])
            ->first();
         } else {
            $assignSale = AsignSaleAmount::where('sale_id', $request->sale_id)
                                         ->where('member_id', $request->member_id)
                                         ->first();
        }
        if ($assignSale &&  $request->amount > $assignSale->amount) {
            return back()->withErrors(['amount' => 'The amount cannot be greater than the available remaining amount']);
        }
        if ($assignSale) {
            if ($request->member_id == 'nagad') {
                $newAmount = $assignSale->amount - $request->amount; // nagad থেকে amount কমানো হচ্ছে
            }
            // 'others' হলে 'others' থেকে amount কমানো হবে
            elseif ($request->member_id == 'others') {
                $newAmount = $assignSale->amount - $request->amount; // others থেকে amount কমানো হচ্ছে
            }
            // অন্য সদস্যদের জন্য সাধারণ কমানো
            else {
                $newAmount = $assignSale->amount - $request->amount; 
            }
        
            // পরিমাণ আপডেট
            $assignSale->amount = $newAmount;
            $assignSale->save();  // Save করা    
        }
    
        // Check if the sale_id exists
        $returnAmount = ReturnAmount::where('sale_id', $request->sale_id)->first();

        if ($returnAmount) {
            // If the sale_id exists, add the new amount to the existing amount
            $returnAmount->amount += $request->amount;
            $returnAmount->date = $formattedDate; // Update the date
            $returnAmount->note = $request->note; // Update the date
            $returnAmount->save();
           
        } else {
            // If the sale_id does not exist, create a new record
            ReturnAmount::create([
                'sale_id' => $request->sale_id,
                'date' => $formattedDate,
                'amount' => $request->amount,
                'note' => $request->note,
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
        public function getMembers($sale_id)
        {
            $members = AsignSaleAmount::where('sale_id', $sale_id)
                        ->with('member') // Assuming relation exists
                        ->get();
            return response()->json($members);
        }
        
            public function getMembersAssignAmount($sale_id,$member_id)
            {
            $payments = AsignSaleAmount::where('sale_id', $sale_id)
                ->where(function ($query) use ($member_id) {
                    $query->where('member_id', $member_id)
                        ->orWhereIn('member_id', ['nagad', 'others']);
                })
                ->get();

            if ($payments->isEmpty()) {
                return response()->json(['message' => 'No payments found for the given sale and member'], 404);
            }
            $result = [];
            foreach ($payments as $payment) {
                if (isset($result[$payment->member_id])) {
                    $result[$payment->member_id] += $payment->amount;
                } else {
                    $result[$payment->member_id] = $payment->amount;
                }
            }


            return response()->json([
                'message' => 'Payments found successfully',
                'payments' => $result, // যেমন nagad => 200, others => 300
            ]);
            }
        


}
