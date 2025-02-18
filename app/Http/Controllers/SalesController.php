<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investments;
use App\Models\Sales;
use Carbon\Carbon;
class SalesController extends Controller
{
    public function index(){
        $investments =  Investments::all();
        return view('backend.pages.sales.sales',compact('investments'));
    }
    public function store(Request $request)
{
    // Validation rules
    $request->validate([
        'investment_id' => 'required',
        'date' => 'required',
        'amount' => 'required|numeric|min:1',
        'details' => 'nullable|string|max:500',
    ]);
    $formattedMonth = Carbon::parse($request->date)->format('Y-m-d');
    $existingSale = Sales::where('investment_id', $request->investment_id)->first();
    if ($existingSale) {
        return redirect()->back()->withErrors(['investment_id' => 'This investment has already been sold!']);
    }
    // Save the savings entry
    $sales = new Sales();
    $sales->investment_id = $request->investment_id;
    $sales->date =  $formattedMonth;
    $sales->amount = $request->amount;
    $sales->details = $request->details;
    $sales->save();

    // Set notification message
    $notification = array(
        'message' => 'Sales  saved Successfully.',
        'alert-type' => 'info'
    );

    // Redirect with notification
    return redirect()->route('sales.view')->with($notification);
}
        public function view(){
            $sales = Sales::with('investments')->latest()->get();
            return view('backend.pages.sales.view-sales', compact('sales'));
        }
        public function edit($id)
        {
            $investments =  Investments::all();
            $sale = Sales::findOrFail($id); // ID অনুযায়ী সঞ্চয় খুঁজবে
        
            return view('backend.pages.sales.edit-sales', compact('sale','investments'));
        }
        public function update(Request $request, $id)
{
    $request->validate([
        'investment_id' => 'required',
        'date' => 'required',
        'amount' => 'required|numeric|min:1',
        'details' => 'nullable|string|max:500',
    ]);
    $formattedMonth = Carbon::parse($request->date)->format('Y-m-d');
    $sales = Sales::findOrFail($id);
    $sales->investment_id = $request->investment_id;
    $sales->date =  $formattedMonth;
    $sales->amount = $request->amount;
    $sales->details = $request->details;
    $sales->save();
    $notification = array(
        'message' => 'Sales  Updated successfully.',
        'alert-type' => 'info'
    );
    return redirect()->route('sales.view')->with($notification);
}
public function delete($id)
{
    $sales = Sales::findOrFail($id);
    $sales->delete();
    $notification = array(
        'message' => 'Sales record deleted successfully.',
        'alert-type' => 'info'
    );
    return redirect()->route('sales.view')->with($notification);
}
}
