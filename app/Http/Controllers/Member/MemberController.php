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

        // ✅ ফাইল আপলোড (যদি ছবি দেওয়া হয়)
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/members', 'public');
        }

        // ✅ ডাটাবেজে সংরক্ষণ
        Member::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'photo' => $photoPath,
            'description' => $request->description,
        ]);

        return redirect()->route('member')->with('success', 'Member added successfully!');
    }
}
