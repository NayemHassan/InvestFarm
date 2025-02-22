<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Savings;
use App\Models\Balance;
use App\Models\Sales;
use App\Models\Fines;
use App\Models\Investments;
use App\Models\ReturnAmount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
class AdminController extends Controller
{
    public function adminDashboard(){
        $inhandBalamce = Balance::latest()->first();
        $totalSaving = Savings::sum('amount');
        $totalInvest = Investments::sum('amount');
        $totalSale = Sales::sum('amount');
        $willProfit =   $totalSale - $totalInvest;
        $collectedProfit = $inhandBalamce->total_profit;
        $dueProfit =  $willProfit - $collectedProfit;
        $totalFines = Fines::sum('amount');
        $totalCollect = ReturnAmount::sum('amount');
        $remeningDue = $totalSale - $totalCollect ?? 0;
        return view('backend.admin.index',compact('inhandBalamce','totalSaving','dueProfit','totalFines','remeningDue'));	
    }
    public function savingsFilter(Request $request)
    {
        $query = Savings::with('member');
    
        // If year is provided, filter by year
        if ($request->year) {
            $query->whereYear('month', $request->year);
        } else {
            // If year is not provided, default to current year
            $query->whereYear('month', Carbon::now()->year);
        }
    
        // If month is provided, filter by month
        if ($request->month) {
            $query->whereMonth('month', $request->month);
        } else {
            // If month is not provided, default to current month
            $query->whereMonth('month', Carbon::now()->month);
        }
    
        // Get the filtered data
        $savings = $query->get();
    
        // Format the 'month' field to display it as 'Month Year' format
        $savings->map(function ($saving) {
            $saving->month = Carbon::parse($saving->month)->format('F Y'); // Example: "February 2025"
            return $saving;
        });
    
        // Return the data as JSON
        return response()->json($savings);
    }
    
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'Logout Successfully.',
            'alert-type' => 'info'
        );
        return redirect('/')->with( $notification);
    }
    public function userProfile(){
        $adminData = Auth::user();
        return view('backend.pages.user-profile.user-profile',compact('adminData'));
    }
    public function userProfileUpdate(Request $request){
        $id =Auth::user()->id;
        $data =User::find($id);
        $data->name = $request->name;
        $data->designation = $request->designation;
        $data->email = $request->email;
        $data->phone = $request->phone;
        if ($request->hasFile('photo')) {
            // পুরোনো ছবি থাকলে সেটি মুছে ফেলুন
            if ($data->photo && file_exists(public_path('uploads/users/' . $data->photo))) {
                unlink(public_path('uploads/users/' . $data->photo));
            }
        
            $image = $request->file('photo');
            $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        
            // ফাইলকে সরাসরি নির্দিষ্ট ফোল্ডারে আপলোড করুন
            $image->move(public_path('uploads/users'), $img_name);
        
            // ডাটাবেসে নতুন ছবির নাম সেভ করুন
            $data->photo = $img_name;
        }
        
        $data->save();
        $notification = array(
            'message' =>'Admin Profile Updated Sccessflly ',
            'alert-type'=> 'info'
         );
        return redirect()->back()->with($notification);
    }
}
