<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category','subcategory','unit'])->get();
        return view('admin.products.index', compact('products'));
    }

    public function getsubCategory(Request $request)
    {
        $subcategories = Category::where("parent_id", $request->catid)->pluck("name", "id");

        if (count($subcategories) > 0) {
            $isSubCat = true;
        }else{
            $isSubCat = false;
            $subcategories = array();
        }

        $res[0] = $isSubCat;
        $res[1] = $subcategories;
        return response()->json($res);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();
        $subcategories = array();
        $units =  Unit::get();

        return view('admin.products.create', compact('categories', 'subcategories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $fileName = null;
        if($request->has('image')){
            $file = $request->file('image');
            $fileName =  'product_'.time().'.'.$file->getClientOriginalExtension();
            // $file->storeAs('product', $fileName);
            $file->move(public_path('app/product/'), $fileName);
        }

        $product = Product::create([
            'catid' => $request->catid,
            'subcatid' => $request->subcatid,
            'product_name' => $request->name,
            'unitid' => $request->unitid,
            'productimage' => $fileName,
            'isfinishedproduct' => $request->isfinishedproduct,
        ]);

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $units =  Unit::get();
        $categories = Category::where('parent_id', 0)->get();
        $product = Product::find($id);
        $subcategories = Category::where('parent_id', $product->catid)->get();
        return view('admin.products.show', compact('categories', 'subcategories', 'units','product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $units =  Unit::get();
        $categories = Category::where('parent_id', 0)->get();
        $product = Product::find($id);
        $subcategories = Category::where('parent_id', $product->catid)->get();
        return view('admin.products.edit', compact('categories', 'subcategories', 'units','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $fileName = null;
        if($request->has('image')){
            $file = $request->file('image');
            try {
                // unlink(storage_path('app/product/'.$request->old_productimage));
                unlink(public_path('app/product/'.$request->old_productimage));
            } catch (Exception $e) {
            }

            $fileName =  'product_'.time().'.'.$file->getClientOriginalExtension();
            // $file->storeAs('product', $fileName);
            $file->move(public_path('app/product/'), $fileName);
        }

        $product->update([
            'catid' => $request->catid,
            'subcatid' => $request->subcatid,
            'product_name' => $request->name,
            'unitid' => $request->unitid,
            'productimage' => $fileName,
            'isfinishedproduct' => $request->isfinishedproduct,
        ]);

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        try{
            // unlink(storage_path('app/product/'.$product->productimage));
            unlink(public_path('app/product/'.$product->productimage));
        }catch(Exception $e){}
        $product->delete();

        return redirect()->route('admin.products.index');
    }
}
