<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Fines;
use Carbon\Carbon;
class FineController extends Controller
{
    public function index(){
        $members =  Member::all();
        return view('backend.pages.fines.fines',compact('members'));
    }
    public function store(Request $request)
{
    // Validation rules
    $request->validate([
        'member_id' => 'required|exists:members,id',
        'date' => 'required',
        'amount' => 'required|numeric|min:1',
        'reason' => 'nullable|string|max:500',
    ]);
    $formattedMonth = Carbon::parse($request->date)->format('Y-m-d');
    // Save the savings entry
    $fines = new Fines();
    $fines->member_id = $request->member_id;
    $fines->date =  $formattedMonth;
    $fines->amount = $request->amount;
    $fines->reason = $request->reason;
    $fines->save();

    // Set notification message
    $notification = array(
        'message' => 'Fines amount saved Successfully.',
        'alert-type' => 'info'
    );

    // Redirect with notification
    return redirect()->route('fines.view')->with($notification);
}
        public function view(){
            $fines = Fines::with('member')->latest()->get();
            return view('backend.pages.fines.view-fines', compact('fines'));
        }
        public function edit($id)
        {
            $members =  Member::all();
            $fines = Fines::findOrFail($id); // ID অনুযায়ী সঞ্চয় খুঁজবে
        
            return view('backend.pages.fines.edit-fines', compact('fines','members'));
        }
        public function update(Request $request, $id)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'note' => 'nullable|string|max:500',
    ]);

    $fines = Fines::findOrFail($id);
    $fines->member_id = $request->member_id;
    $fines->amount = $request->amount;
    $fines->date = $request->date;
    $fines->reason = $request->reason;
    $fines->save();
    $notification = array(
        'message' => 'Fines  Updated successfully.',
        'alert-type' => 'info'
    );
    return redirect()->route('fines.view')->with($notification);
}
public function delete($id)
{
    $savings = Fines::findOrFail($id);
    $savings->delete();
    $notification = array(
        'message' => 'Fines record deleted successfully.',
        'alert-type' => 'info'
    );
    return redirect()->route('fines.view')->with($notification);
}
}
