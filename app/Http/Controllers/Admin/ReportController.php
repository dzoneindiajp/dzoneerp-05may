<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Finished;
use App\Models\Processing;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class ReportController extends Controller
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

    public function processingReport()
    {
        $purchases = Purchase::where('status',1)->get();
        return view('admin.reports.product.processing', compact('purchases'));
    }
    public function getprocessingReport(Request $request)
    {

        $from = date('Y-m-d', strtotime($request->fromDate));
        $to = date('Y-m-d', strtotime($request->toDate));
        $purchase = $request->purchase;


        if ($from && $to) {
            if($purchase == null){
                $processing = Processing::with('purchase')->where('start_date', '>=', $from)->where('start_date', '<=', $to)->get();
            }else{
                $processing = Processing::with('purchase')->where('start_date', '>=', $from)->where('start_date', '<=', $to)->where('purchase_id','=',$purchase)->get();
            }
            if ($processing != null) {
                $res['from'] = $from;
                $res['to'] = $to;
                $purchases = $processing;
                return view('admin.reports.product.processing_report', compact('purchases','res'));
            }
        }
    }

    public function finishedReport()
    {
        $processings = Processing::where('status',1)->get();
        return view('admin.reports.product.finished', compact('processings'));
    }
    public function getfinishedReport(Request $request)
    {

        $from = date('Y-m-d', strtotime($request->fromDate));
        $to = date('Y-m-d', strtotime($request->toDate));
        $processing = $request->processing;


        if ($from && $to) {
            if($processing == null){
                $processing = Finished::with('processing')->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->get();
            }else{
                $processing = Finished::with('processing')->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->where('processing_id','=',$processing)->get();
            }
            if ($processing != null) {
                $res['from'] = $from;
                $res['to'] = $to;
                $purchases = $processing;
                return view('admin.reports.product.finished_report', compact('purchases','res'));
            }
        }
    }
}
