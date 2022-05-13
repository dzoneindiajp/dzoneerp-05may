<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DamagePurchaseRequest;
use App\Models\DamagePurchase;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\ReturnPurchase;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;

class DamagePurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $damage = DamagePurchase::get();
        return view('admin.damage_purchases.index',compact('damage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $damages = DamagePurchase::pluck('purchase_id');
        $returns = ReturnPurchase::pluck('purchase_id');
        $purchases = Purchase::where('status', 1)->whereIn('id',$returns)->whereNotIn('id',$damages)->get();
        return view('admin.damage_purchases.create', compact('purchases'));
    }

    public function getproducts(Request $request)
    {
        if ($request->purchase_id != null) {
            $purchases = Purchase::where("id", $request->purchase_id)->first();
            $return = ReturnPurchase::where('purchase_id', $request->purchase_id)->first();
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

        if ($request->damage_qty == 0) {
            return response()->view('admin.damage_purchases.damage_purchases_product', compact('res', 'products', 'units','return'));
        } else {
            $damage = DamagePurchase::where('purchase_id', $request->purchase_id)->first();
            return response()->view('admin.damage_purchases.damage_purchases_product', compact('res', 'products', 'units', 'damage','return'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DamagePurchaseRequest $request)
    {
        $fileName = null;

        if ($request->has('image')) {
            $file = $request->file('image');
            $fileName  = 'damage_purchase_' . time() . '.' . $file->getClientOriginalExtension();
            // $file->storeAs('product', $fileName);
            $file->move(public_path('app/damage_purchase/'), $fileName);
        }

        $pur = DamagePurchase::latest()->first('id');
        if ($pur != null) {
            $id = $pur->id;
            $damage_code = 'DAMAGE - ' . ($id + 1);
        } else {
            $damage_code = 'DAMAGE - 1';
        }

        DamagePurchase::create([
            'damage_code' => $damage_code,
            'damage_date' => date('Y-m-d', strtotime($request->date)),
            'damage_reason' => $request->reason,
            'purchase_id' => $request->purchase,
            'damageqty' => json_encode($request->damageqty),
            'damage_note' => $request->note,
            'damage_image' => $fileName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.damagepurchases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $damage = DamagePurchase::find($id);
        $products = Product::get();
        $units =  Unit::get();
        $purchases = Purchase::get();

        return view('admin.damage_purchases.show', compact('products', 'units', 'purchases', 'damage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $damage = DamagePurchase::find($id);
        $products = Product::get();
        $units =  Unit::get();
        $purchases = Purchase::get();

        return view('admin.damage_purchases.edit', compact('products', 'units', 'purchases', 'damage'));
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
        $damage = DamagePurchase::find($id);
        $fileName = null;

        if ($request->has('image')) {
            $file = $request->file('image');
            $fileName  = 'damage_purchase_' . time() . '.' . $file->getClientOriginalExtension();
            try {
                unlink(public_path('app/damage_purchase/' . $request->old_image));
            } catch (Exception $e) {
            }

            $file->move(public_path('app/damage_purchase/'), $fileName);
        } else {
            $fileName  = $request->old_image;
        }

        $damage->update([
            'damage_date' => date('Y-m-d', strtotime($request->date)),
            'damage_reason' => $request->reason,
            'purchase_id' => $request->purchase,
            'damageqty' => json_encode($request->damageqty),
            'damage_note' => $request->note,
            'damage_image' => $fileName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.damagepurchases.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $damage = DamagePurchase::find($id);
        try{
            unlink(public_path('app/damage_purchase/'.$damage->damage_image));
        }catch(Exception $e){}

        $damage->delete();
        return redirect()->route('admin.damagepurchases.index');

    }
}
