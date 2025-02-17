<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Savings;
use Carbon\Carbon;

class SavingController extends Controller
{
    public function index(){
        $members =  Member::all();
        return view('backend.pages.savings.savings',compact('members'));
    }
    public function store(Request $request)
{
    // Validation rules
    $request->validate([
        'member_id' => 'required|exists:members,id',
        'month' => 'required',
        'amount' => 'required|numeric|min:1',
        'note' => 'nullable|string|max:500',
    ]);
    $formattedMonth = Carbon::parse($request->month)->format('Y-m-d');

    // Save the savings entry
    $savings = new Savings();
    $savings->member_id = $request->member_id;
    $savings->month =  $formattedMonth;
    $savings->amount = $request->amount;
    $savings->note = $request->note;
    $savings->save();

    // Set notification message
    $notification = array(
        'message' => 'Savings amount saved successfully.',
        'alert-type' => 'info'
    );

    // Redirect with notification
    return redirect()->route('savings.view')->with($notification);
}
        public function view(){
            $savings = Savings::with('member')->latest()->get();
            return view('backend.pages.savings.view-savings', compact('savings'));
        }
        public function edit($id)
        {
            $members =  Member::all();
            $savings = Savings::findOrFail($id); // ID অনুযায়ী সঞ্চয় খুঁজবে
        
            return view('backend.pages.savings.edit-savings', compact('savings','members'));
        }
        public function update(Request $request, $id)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'note' => 'nullable|string|max:500',
    ]);

    $savings = Savings::findOrFail($id);
    $savings->amount = $request->amount;
    $savings->note = $request->note;
    $savings->save();
    $notification = array(
        'message' => 'Savings  Updated successfully.',
        'alert-type' => 'info'
    );
    return redirect()->route('savings.view')->with($notification);
}
public function delete($id)
{
    $savings = Savings::findOrFail($id);
    $savings->delete();
    $notification = array(
        'message' => 'Savings record deleted successfully.',
        'alert-type' => 'info'
    );
    return redirect()->route('savings.view')->with($notification);
}

        
}
 