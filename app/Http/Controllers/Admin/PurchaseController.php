<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Models\Category;
use App\Models\DamagePurchase;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\ReturnPurchase;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::get();
        return view('admin.purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        $units =  Unit::get();
        $suppliers =  Supplier::where('status', 1)->get();
        $vendors =  Vendor::where('status', 1)->get();

        return view('admin.purchases.create', compact('products', 'units', 'suppliers', 'vendors'));
    }


    public function getUsers(Request $request)
    {
        if ($request->user_type == 0) {
            $users = Supplier::where("status", 1)->pluck("name", "id");
            $isUser = true;
        } else {
            $users = Vendor::where("status", 1)->pluck("name", "id");
            $isUser = true;
        }

        if (count($users) > 0) {} else {
            $isUser = false;
            $users = array();
        }

        $res[0] = $isUser;
        $res[1] = $users;
        return response()->json($res);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        $fileName = null;
        if($request->has('image')){
            $file = $request->file('image');
            $fileName  = 'purchase_'.time().'.'.$file->getClientOriginalExtension();
            // $file->storeAs('product', $fileName);
            $file->move(public_path('app/purchase/'), $fileName);
        }
        $pur = Purchase::latest()->first('id');
        $id = $pur->id;
        $purchase_code = 'PUR - '.($id + 1);

        $purchase = Purchase::create([
            'purchase_code'=> $purchase_code,
            'purchase_date' => date('Y-m-d',strtotime($request->date)),
            'user_type' => $request->usertype,
            'user_id' => $request->userid,
            'product_id' => json_encode($request->product),
            'product_qty' => json_encode($request->qty),
            'unit_id' => json_encode($request->unitid),
            'unit_price' => json_encode($request->unitprice),
            'discount' => json_encode($request->discount),
            'subtotal' => $request->subtotal,
            'total_discount' => $request->totaldiscount,
            'transport_cost' => $request->transportcost,
            'grand_total' => $request->grandtotal,
            'purchase_note' => $request->note,
            'purchase_image' => $fileName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.purchases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = Purchase::find($id);
        $products = Product::get();
        $units =  Unit::get();
        $damagePurchase = DamagePurchase::where('purchase_id',$purchase->id)->first();
        $returnPurchase = ReturnPurchase::where('purchase_id',$purchase->id)->first();

        if($purchase->user_type == 0){
            // $suppliers =  Supplier::where('status', 1)->where('id',$purchase->user_id)->first();
            $user =  Supplier::where('status', 1)->where('id',$purchase->user_id)->first();
        }else{
            // $vendors =  Vendor::where('status', 1)->where('id',$purchase->user_id)->first();
            $user =  Vendor::where('status', 1)->where('id',$purchase->user_id)->first();
        }

        // return view('admin.purchases.show', compact('products', 'units', 'suppliers', 'vendors','purchase'));
        return view('admin.purchases.show', compact('products', 'units', 'user','purchase','damagePurchase','returnPurchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::find($id);
        $products = Product::get();
        $units =  Unit::get();
        $suppliers =  Supplier::where('status', 1)->get();
        $vendors =  Vendor::where('status', 1)->get();

        return view('admin.purchases.edit', compact('products', 'units', 'suppliers', 'vendors','purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseRequest $request, $id)
    {
        $fileName = null;
        if($request->has('image')){
            $file = $request->file('image');
            $fileName  = 'Purchase_'.time().'.'.$file->getClientOriginalExtension();
            try{
                unlink(public_path('app/purchase/'.$request->old_image));
            }catch(Exception $e){}
            // $file->storeAs('product', $fileName);
            $file->move(public_path('app/purchase/'), $fileName);
        }else{
            $fileName = $request->old_image;
        }

        Purchase::find($id)->update([
            'purchase_date' => date('Y-m-d',strtotime($request->date)),
            'user_type' => $request->usertype,
            'user_id' => $request->userid,
            'product_id' => json_encode($request->product),
            'product_qty' => json_encode($request->qty),
            'unit_id' => json_encode($request->unitid),
            'unit_price' => json_encode($request->unitprice),
            'discount' => json_encode($request->discount),
            'subtotal' => $request->subtotal,
            'total_discount' => $request->totaldiscount,
            'transport_cost' => $request->transportcost,
            'grand_total' => $request->grandtotal,
            'purchase_note' => $request->note,
            'purchase_image' => $fileName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.purchases.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::find($id);

        try{
            unlink(public_path('app/purchase/'.$purchase->purchase_image));
        }catch(Exception $e){}

        $purchase->delete();
        return redirect()->route('admin.purchases.index');

    }
}
