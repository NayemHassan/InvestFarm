<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Sales;
use App\Models\AsignSaleAmount;
use  Carbon\Carbon;
class AsignSaleAmountController extends Controller
{
    public function index(){
   
        $sales = Sales::all();
        return view('backend.pages.asign-sale-amount.asign-sale-amount',compact('sales'));
    }
    public function getSaleAmount($sale_id)
        {
    // Find the sale by ID and get the amount (you can adjust this depending on your database structure)
    $sale = Sales::findOrFail($sale_id);
        if ($sale) {
            return response()->json(['amount' => $sale->amount]);  // Assuming 'amount' is the field storing the sale amount
        }
        return response()->json(['amount' => 0]);  // Return 0 if no sale is found
    }   
    public function store(Request $request){
        $validatedData  =   $request->validate([
           'member_id' =>'required',
           'sale_id' =>'required',
           'amount' =>'required',
           'date' => 'required',
           'note' =>'nullable',
        ]);

           $validatedData['date'] = Carbon::parse($request->date)->format('Y-m-d');
           $validatedData['old_amount'] = $validatedData['amount'];
             // Store the validated and formatted data
             AsignSaleAmount::create($validatedData);
             $notification = array(
                'message' => 'Sale Amount Assigned Successfully',
                'alert-type' => 'info'
            );
        
        return redirect()->route('assign.amount.view')->with( $notification);
    }
    public function view(){
        $asignSaleAmounts = AsignSaleAmount::latest()->get();
        return view('backend.pages.asign-sale-amount.view-asign-sale-amount', compact('asignSaleAmounts'));
    }
    public function edit($id){
        $members =  Member::all();
        $sales = Sales::all();
        $asignSaleAmount = AsignSaleAmount::findOrFail($id); 
        return view('backend.pages.asign-sale-amount.edit-asign-sale-amount', compact('asignSaleAmount','members','sales'));
    }
    public function update(Request $request, $id)
{
    // Validate the input data
    $validatedData = $request->validate([
        'member_id' => 'required',
        'sale_id' => 'required',
        'amount' => 'required|numeric',
        'date' => 'required',
        'note' => 'nullable|string',
    ]);

    // Format the date field
    $validatedData['date'] = Carbon::parse($request->date)->format('Y-m-d');
   
    // Find the AsignSaleAmount record by its ID
    $asignSaleAmount = AsignSaleAmount::find($id);

    // If the record doesn't exist, return with an error message
    if (!$asignSaleAmount) {
        return redirect()->route('asign-sale-amount.view')->with([
            'message' => 'Sale Amount record not found.',
            'alert-type' => 'error',
        ]);
    }
    $validatedData['amount'] = $asignSaleAmount->amount + $validatedData['amount'];
    $oldAmount = $asignSaleAmount->old_amount ?? 0; 
    $validatedData['old_amount'] = $oldAmount + $request->amount; 
    $asignSaleAmount->update($validatedData);

    // Prepare success notification
    $notification = array(
        'message' => 'Sale Amount Updated Successfully',
        'alert-type' => 'success',
    );

    // Redirect back with success notification
    return redirect()->route('assign.amount.view')->with($notification);
}
public function getAvailableMembers($sale_id)
{
    $assignedMemberIds = AsignSaleAmount::where('sale_id', $sale_id)
                            ->whereNotIn('member_id', ['nagad', 'others'])
                            ->pluck('member_id')
                            ->toArray();

    $availableMembers = Member::whereNotIn('id', $assignedMemberIds)->get();
    $nagadAssigned = AsignSaleAmount::where('sale_id', $sale_id)
                         ->where('member_id', 'nagad')
                         ->exists();

    $othersAssigned = AsignSaleAmount::where('sale_id', $sale_id)
                         ->where('member_id', 'others')
                         ->exists();

    return response()->json([
        'availableMembers' => $availableMembers,
        'nagadAvailable'   => !$nagadAssigned,
        'othersAvailable'  => !$othersAssigned,
    ]);
}
}
