<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Vendor;
use Illuminate\Http\Request;

class PurchaseReportController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::get();
        $vendors = Vendor::get();

        return view('admin.reports.purchase.index', compact('suppliers','vendors'));
    }
    public function getReport(Request $request)
    {

        $from = date('Y-m-d', strtotime($request->fromDate));
        $to = date('Y-m-d', strtotime($request->toDate));
        $supplier = $request->supplier;


        if ($from && $to) {
            if($supplier == null){
                $purchases = Purchase::where('purchase_date', '>=', $from)->where('purchase_date', '<=', $to)->get();
            }else{
                $purchases = Purchase::where('purchase_date', '>=', $from)->where('purchase_date', '<=', $to)->where('user_id','=',$supplier)->get();
            }
            if ($purchases != null) {
                $res['from'] = $from;
                $res['to'] = $to;

                return view('admin.reports.purchase.report', compact('purchases','res'));
            }
        }
    }
}
