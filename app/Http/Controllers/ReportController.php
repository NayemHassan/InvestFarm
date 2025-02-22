<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignSaleAmount;
use App\Models\Sales;
class ReportController extends Controller
{
    public function viewCollectionDueReport(){
        $asignSaleAmounts = AsignSaleAmount::latest()->get();
        $sales = Sales::all();
        return view('backend.reports.individual_due_collection',compact('asignSaleAmounts','sales'));
    }
    public function filterSaleReport(Request $request)
    {
    
        if ($request->has('sale_id') && $request->sale_id != '') {
            $asignSaleAmounts = AsignSaleAmount::with(['member', 'sales.investments'])
                ->where('sale_id', $request->sale_id)
                ->get();
        } else {
            $asignSaleAmounts = AsignSaleAmount::with(['member', 'sales.investments'])->get();
        }
        return response()->json([
            'status' => 'success',
            'data' => $asignSaleAmounts
        ]);
    }
}
