<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
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
    public function MakeUser(){
        return view('backend.pages.user-make.user-make');
    }
    public function userStore(Request $request)
    {
        // ভ্যালিডেশন রুলস
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'designation' => 'nullable|string|max:255',
            'role' => 'required|in:admin,user', // শুধুমাত্র 'admin' বা 'user' হতে পারে
            'password' => 'required|string|min:8',
        ]);
    
        // ইমেজ আপলোড এবং প্রসেসিং
        $photoName = null;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $photoName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/users'), $photoName);
        }
    
        // ডেটাবেসে স্টোর করুন
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->photo = $photoName;
        $user->designation = $request->designation;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        if($request->role){
            $user->role = $request->role;
        }else{
            $user->role = 'user';
        }
        $user->save();
        $notification = array(
            'message' => 'User ' . $request->name . ' Created successfully.',
            'alert-type' => 'info'
        );
        // সফল মেসেজ সহ রিডাইরেক্ট করুন
        return redirect()->route('view.users')->with($notification);
    }
    public function viewUsers(){
        $users = User::all();
        return view('backend.pages.user-make.view-user', compact('users'));
    }
    // Edit User
        public function editUser($id)
        {
            $user = User::findOrFail($id);
            return view('backend.pages.user-make.edit-user', compact('user'));
        }
        public function userUpdate(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:15',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'role' => 'required|in:admin,user',
        'designation' => 'nullable|string|max:255',
        'password' => 'nullable|string|min:8',
    ]);

    // Update user data
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->role = $request->role;
    $user->designation = $request->designation;

    // Update password if provided
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }
    $photoName = $user->photo; // Keep the old photo by default

    if ($request->hasFile('photo')) {
        // আগের ছবি মুছে ফেলা (যদি থেকে থাকে)
        if (!empty($user->photo) && file_exists(public_path('uploads/users/' . $user->photo))) {
            unlink(public_path('uploads/users/' . $user->photo));
        }
    
        // নতুন ছবি আপলোড
        $image = $request->file('photo');
        $photoName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/users'), $photoName);
    
        // নতুন ছবির নাম ডাটাবেজে সংরক্ষণ
        $user->photo = $photoName;
    }
    
    $user->save();
    $notification = array(
        'message' => 'User updated successfully',
        'alert-type' => 'info'
    );
    return redirect()->route('view.users')->with($notification);
}
public function deleteUser($id)
{

    $user = User::findOrFail($id);


    if ($user->photo && file_exists(public_path('uploads/users/' . $user->photo))) {
        unlink(public_path('uploads/users/' . $user->photo));
    }


    $user->delete();
    $notification = array(
        'message' => 'User Deleted  successfully.',
        'alert-type' => 'info'
    );
    return redirect()->route('view.users')->with($notification);
}
}
