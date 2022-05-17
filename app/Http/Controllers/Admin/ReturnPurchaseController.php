<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReturnPurchaseRequest;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\ReturnPurchase;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;

class ReturnPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $return = ReturnPurchase::with(['purchase'])->get();
        return view('admin.return_purchases.index', compact('return'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $purchases = Purchase::where('status', 1)->get();
        $returns = ReturnPurchase::pluck('purchase_id');
        $purchases = Purchase::where('status', 1)->whereNotIn('id',$returns)->get();
        return view('admin.return_purchases.create', compact('purchases'));
    }

    public function getproducts(Request $request)
    {
        if ($request->purchase_id != null) {
            $purchases = Purchase::where("id", $request->purchase_id)->first();
            $products = Product::get();
            $units =  Unit::get();
            $isRecord = true;
        } else {
            $isRecord = false;
            $purchases = array();
            $products = array();
            $units = array();
        }

        $res[0] = $isRecord;
        $res[1] = $purchases;


        if ($request->return_qty == 0) {
            return response()->view('admin.return_purchases.return_purchases_product', compact('res', 'products', 'units'));
        } else {
            $return = ReturnPurchase::where('purchase_id', $request->purchase_id)->first();
            return response()->view('admin.return_purchases.return_purchases_product', compact('res', 'products', 'units', 'return'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReturnPurchaseRequest $request)
    {
        $fileName = null;

        if ($request->has('image')) {
            $file = $request->file('image');
            $fileName  = 'return_purchase_' . time() . '.' . $file->getClientOriginalExtension();
            // $file->storeAs('product', $fileName);
            $file->move(public_path('app/return_purchase/'), $fileName);
        }

        $pur = ReturnPurchase::latest()->first('id');
        if ($pur != null) {
            $id = $pur->id;
            $return_code = 'RETURN - ' . ($id + 1);
        } else {
            $return_code = 'RETURN - 1';
        }

        ReturnPurchase::create([
            'return_code' => $return_code,
            'return_date' => date('Y-m-d', strtotime($request->date)),
            'return_reason' => $request->reason,
            'purchase_id' => $request->purchase,
            'returnqty' => json_encode($request->returnqty),
            'return_amount' => $request->refundamount,
            'return_note' => $request->note,
            'return_image' => $fileName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.returnpurchases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $return = ReturnPurchase::find($id);
        $products = Product::get();
        $units =  Unit::get();
        $purchases = Purchase::get();

        return view('admin.return_purchases.show', compact('products', 'units', 'purchases', 'return'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $return = ReturnPurchase::find($id);
        $products = Product::get();
        $units =  Unit::get();
        $purchases = Purchase::get();

        return view('admin.return_purchases.edit', compact('products', 'units', 'purchases', 'return'));
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
        $return = ReturnPurchase::find($id);
        $fileName = null;

        if ($request->has('image')) {
            $file = $request->file('image');
            $fileName  = 'return_purchase_' . time() . '.' . $file->getClientOriginalExtension();
            try {
                unlink(public_path('app/return_purchase/' . $request->old_image));
            } catch (Exception $e) {
            }

            $file->move(public_path('app/return_purchase/'), $fileName);
        } else {
            $fileName  = $request->old_image;
        }

        $return->update([
            'return_date' => date('Y-m-d', strtotime($request->date)),
            'return_reason' => $request->reason,
            'purchase_id' => $request->purchase,
            'returnqty' => json_encode($request->returnqty),
            'return_amount' => $request->refundamount,
            'return_note' => $request->note,
            'return_image' => $fileName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.returnpurchases.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $return = ReturnPurchase::find($id);
        try{
            unlink(public_path('app/return_purchase/'.$return->return_image));
        }catch(Exception $e){}

        $return->delete();
        return redirect()->route('admin.returnpurchases.index');

    }
}
