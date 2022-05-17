<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcessingRequest;
use App\Models\Processing;
use App\Models\Product;
use App\Models\Purchase;
use Exception;
use Illuminate\Http\Request;

class ProcessingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processings = Processing::get();
        return view('admin.processings.index',compact('processings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchases = Purchase::where('status',1)->get();
        return view('admin.processings.create',compact('purchases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileName = null;
        if($request->has('image')){
            $file = $request->file('image');
            $fileName  = 'processing_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('app/processing/'), $fileName);
        }

        $pur = Processing::latest()->first('id');

        if ($pur != null) {
            $id = $pur->id;
            $processing_code = 'PRO - '.($id + 1);
        } else {
            $processing_code = 'PRO - 1';
        }

        $processing = Processing::create([
            'purchase_id' => $request->product,
            'processing_code'=> $processing_code,
            'start_date' => date('Y-m-d',strtotime($request->startdate)),
            'end_date' => (isset($request->enddate)) ? date('Y-m-d',strtotime($request->enddate)) : null,
            'processing_note' => $request->note,
            'processing_image' => $fileName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.processings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $processing = Processing::with('purchase')->find($id);

        return view('admin.processings.show', compact( 'processing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $processing = Processing::find($id);
        $purchases = Purchase::where('status',1)->get();

        return view('admin.processings.edit', compact('purchases', 'processing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProcessingRequest $request, $id)
    {
        $processing = Processing::find($id);
        $fileName = null;
        if($request->has('image')){
            $file = $request->file('image');
            $fileName  = 'processing_'.time().'.'.$file->getClientOriginalExtension();
            try{
                unlink(public_path('app/processing/'.$request->old_image));
            }catch(Exception $e){}
            $file->move(public_path('app/processing/'), $fileName);
        }else{
            $fileName = $request->old_image;
        }

        $processing->update([
            'purchase_id' => $request->product,
            'start_date' => date('Y-m-d',strtotime($request->startdate)),
            'end_date' => (isset($request->enddate)) ? date('Y-m-d',strtotime($request->enddate)) : null,
            'processing_note' => $request->note,
            'processing_image' => $fileName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.processings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $processing = Processing::find($id);

        try{
            unlink(public_path('app/processing/'.$processing->processing_image));
        }catch(Exception $e){}

        $processing->delete();

        return redirect()->route('admin.processings.index');
    }
}
