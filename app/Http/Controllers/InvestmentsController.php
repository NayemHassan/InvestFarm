<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Investments;
use App\Models\Transactions;
use App\Models\Balance;
class InvestmentsController extends Controller
{
    public function index(){
        return view('backend.pages.investment.investment');
    }
    public function storeInvestment(Request $request)
    {
        // ✅ Validation
        // dd($request->all());
        $request->validate([
            'type' => 'required', // Type is required (string expected)
            'date' => 'required', // Date is required and should be in a valid date format
            'amount' => 'required|numeric', // Amount is required and should be a valid numeric value (can be integer or decimal)
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Image is optional but if provided, it should be of type jpg, png, or jpeg and <= 2MB
            'details' => 'nullable|string', // Details is optional and should be a string if provided
        ]);
    
        // Handle file upload
        $photoPath = null;
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/Investments'), $photoName);
            $photoPath = 'uploads/Investments/' . $photoName;
        }
    
        // Format the date
        $formattedDate = Carbon::parse($request->date)->format('Y-m-d');
    
        // ✅ Insert data into the database
       $investments =  Investments::create([
            'type' => $request->type, // Type is a string
            'amount' => $request->amount, // Amount is now set correctly as a numeric value
            'date' => $formattedDate,
            'image' => $photoPath,
            'details' => $request->details,
        ]);
        $transaction = Transactions::create([
            'type' => 'Investments',
            'amount' => $request->amount,
            'investments_id' =>  $investments->id,
            'date' => Carbon::now(),
            'details' => 'Investments Amount Provided',
        ]);
        $balance = Balance::first(); // প্রথম ব্যালান্স রেকর্ড খুঁজবে
    
        if ($balance) {
            $balance->total_balance -= $request->amount;
            $balance->save();
        } else {
            // যদি Balance টেবিলে কোনো এন্ট্রি না থাকে, তাহলে নতুন এন্ট্রি তৈরি করবে
            Balance::create([
                'total_balance' => $request->amount,
            ]);
        }
        // Success notification
        $notification = array(
            'message' => 'Investment Added Successfully',
            'alert-type' => 'info',
        );
    
        // Redirect to investments view with notification
        return redirect()->route('investment.view')->with($notification);
    }
    public function view(){
        $investments = Investments::all();
        return view('backend.pages.investment.view-investments', compact('investments'));
    }
    public function edit($id)
    {

        $investment = Investments::findOrFail($id); // ID অনুযায়ী সঞ্চয় খুঁজবে
    
        return view('backend.pages.investment.edit-investments', compact('investment'));
    }
    public function update(Request $request ,$id){
        $request->validate([
            'type' => 'required|string',
            'date' => 'required',
          
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'details' => 'nullable|string',
        ]);
        
        // Format the date
        $formattedDate = Carbon::parse($request->date)->format('Y-m-d');
        
        $investment = Investments::findOrFail($id);
    
        // Handle file upload
        $photoPath = $investment->image; 
        
        if ($request->hasFile('image')) {
            // Delete the old image if a new one is uploaded
            if ($investment->image && file_exists(public_path($investment->image))) {
                unlink(public_path($investment->image));  
            }
    
            // Upload new image
            $photo = $request->file('image');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/Investments'), $photoName);
            $photoPath = 'uploads/Investments/' . $photoName;
        }
    
        // Update the investment data
        $investment->type = $request->type;
        // $investment->amount = $request->amount;
        $investment->date = $formattedDate;
        $investment->image = $photoPath;
        $investment->details = $request->details;
    
        // Save the updated investment record
        $investment->save();
        
        // Success notification
        $notification = array(
            'message' => 'Investment Updated Successfully',
            'alert-type' => 'info',
        );
    
        // Redirect with success notification
        return redirect()->route('investment.view')->with($notification);
    }
    public function delete($id)
    {
        // Find the savings (investment) record by ID
        $investments = Investments::findOrFail($id);
    
        // Check if there is an image associated with the investment and delete it from the storage
        if ($investments->image && file_exists(public_path($investments->image))) {
            unlink(public_path($investments->image)); 
        }
    
        // Delete the record from the database
        $investments->delete();
    
        // Prepare the success notification
        $notification = array(
            'message' => 'Investment record deleted successfully.',
            'alert-type' => 'info'
        );
    
        // Redirect with the notification
        return redirect()->route('investment.view')->with($notification);
    }
    
}
