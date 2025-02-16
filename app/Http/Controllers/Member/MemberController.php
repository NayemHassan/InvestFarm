<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class MemberController extends Controller
{
    public function index(){
        return view('backend.pages.members.members');
    }
    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'nullable|string',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/members'), $photoName);
            $photoPath = 'uploads/members/' . $photoName;
        }
    
        // ✅ ডাটাবেজে সংরক্ষণ
        Member::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'photo' => $photoPath,
            'description' => $request->description,
        ]);
        $notification = array(
            'message' =>'Member Added Successfully ',
            'alert-type'=> 'info'
         );
        return redirect()->route('view.member')->with($notification);
    }
    public function view(){
        $members = Member::all();
        return view('backend.pages.members.view-members', compact('members'));
    }
    public function edit($id)
{
    $member = Member::findOrFail($id);
    return view('backend.pages.members.edit-members', compact('member'));
}
// Show edit form


// Handle update request
public function update(Request $request, $id)
{
    $member = Member::findOrFail($id);
    
    // ✅ Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'nullable|string|max:1000',
    ]);

    // ✅ মেম্বার তথ্য আপডেট
    $member->name = $request->name;
    $member->phone = $request->phone;
    $member->description = $request->description;

    // ✅ নতুন ছবি আপলোড হলে পুরনো ছবি ডিলিট করা হবে
    if ($request->hasFile('photo')) {
        // পুরাতন ছবি ডিলিট করা (যদি থাকে)
        if ($member->photo && file_exists(public_path($member->photo))) {
            unlink(public_path($member->photo)); 
        }

        // নতুন ছবি সংরক্ষণ করা
        $photo = $request->file('photo');
        $photoName = time() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('uploads/members'), $photoName);
        $member->photo = 'uploads/members/' . $photoName;
    }

    // ✅ যদি নতুন ছবি না থাকে, তাহলে আগের ছবি রেখে দেবে
    else {
        $member->photo = $member->photo; 
    }

    $member->save(); // ✅ মেম্বার আপডেট সংরক্ষণ

    // ✅ সফল মেসেজ সহ রিডাইরেক্ট
    return redirect()->route('view.member')->with('message', 'Member updated successfully');
}

public function delete($id)
{
    $member = Member::findOrFail($id);

    // ✅ যদি মেম্বারের ছবি থাকে, তাহলে সেটি ডিলিট করা হবে
    if ($member->photo && file_exists(public_path($member->photo))) {
        unlink(public_path($member->photo));
    }

    $member->delete(); // ✅ মেম্বার ডিলিট করা হলো

    return redirect()->route('view.member')->with('success', 'Member deleted successfully!');
}


}
