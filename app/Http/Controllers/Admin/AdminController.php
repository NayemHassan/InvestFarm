<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Savings;
use Carbon\Carbon;
class AdminController extends Controller
{
    public function adminDashboard(){
        
        return view('backend.admin.index');	
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
    

}
