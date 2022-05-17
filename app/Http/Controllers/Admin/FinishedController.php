<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FinishedRequest;
use App\Models\DamagePurchase;
use App\Models\Finished;
use App\Models\Processing;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\ReturnPurchase;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\Process\Process;

class FinishedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finished = Finished::with(['processing'])->get();
        return view('admin.finished.index', compact('finished'));
    }


    public function getProcessing(Request $request)
    {
        if ($request->processing_id != null) {
            $processing = Processing::with(['purchase'])->where("id", $request->processing_id)->first();
            $purchase = Purchase::where("id", $processing->purchase_id)->first();

            $returnPurchase = ReturnPurchase::where("purchase_id", $processing->purchase_id)->first();
            $damagePurchase = DamagePurchase::where("purchase_id", $processing->purchase_id)->first();

            $products = Product::get();
            $units =  Unit::get();
            $isRecord = true;
        } else {
            $isRecord = false;
            $purchase = array();
            $products = array();
            $units = array();
            $returnPurchase = array();
            $damagePurchase = array();
        }

        $res[0] = $isRecord;
        $res[1] = $processing;


        if ($request->finished_qty == 0) {
            return response()->view('admin.finished.return_purchases_product', compact('res', 'purchase' ,'products', 'units','returnPurchase','damagePurchase'));
        } else {
            $finished = Finished::where('processing_id', $request->processing_id)->first();

            return response()->view('admin.finished.return_purchases_product', compact('res', 'purchase','products', 'units','returnPurchase','damagePurchase', 'finished'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $finished = Finished::get();
        $processings = Processing::get();

        return view('admin.finished.create', compact('finished', 'processings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FinishedRequest $request)
    {
        $fileName = null;
        if($request->has('image')){
            $file = $request->file('image');
            $fileName  = 'purchase_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('app/finished/'), $fileName);
        }

        $pur = Finished::latest()->first('id');

        if ($pur != null) {
            $id = $pur->id;
            $finished_code = 'FINISHED - '.($id + 1);
        } else {
            $finished_code = 'FINISHED - 1';
        }


        $purchase = Finished::create([
            'processing_id' => $request->processing,
            'purchase_id' => $request->purchase_id,
            'finished_code'=> $finished_code,
            'finished_date' => date('Y-m-d',strtotime($request->date)),
            'product_name' => json_encode($request->product_name),
            'purchase_qty' => json_encode($request->product_qty),
            'available_qty' => json_encode($request->available_qty),
            'unit_name' => json_encode($request->unit_name),
            'used_qty' => json_encode($request->used_qty),
            'finished_note' => $request->note,
            'finished_image' => $fileName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.finished.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $finished = Finished::with(['processing','purchase'])->find($id);
        $processings = Processing::get();

        return view('admin.finished.show', compact('finished', 'processings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $finished = Finished::find($id);
        $processings = Processing::get();

        return view('admin.finished.edit', compact('finished', 'processings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $finished = Finished::find($id);

        $fileName = null;
        if($request->has('image')){
            $file = $request->file('image');
            $fileName  = 'purchase_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('app/finished/'), $fileName);
        }else{
            $fileName = $request->old_image;
        }

        $finished->update([
            'processing_id' => $request->processing,
            'purchase_id' => $request->purchase_id,
            'finished_date' => date('Y-m-d',strtotime($request->date)),
            'product_name' => json_encode($request->product_name),
            'purchase_qty' => json_encode($request->product_qty),
            'available_qty' => json_encode($request->available_qty),
            'unit_name' => json_encode($request->unit_name),
            'used_qty' => json_encode($request->used_qty),
            'finished_note' => $request->note,
            'finished_image' => $fileName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.finished.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $finished = Finished::find($id);
        try{
            unlink(public_path('app/finished/'.$finished->finished_image));
        }catch(Exception $e){}
        $finished->delete();

        return redirect()->route('admin.finished.index');

    }
}
