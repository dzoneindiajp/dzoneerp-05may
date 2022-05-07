<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Countries;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_if(Gate::denies('supplier_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::where('user_type',2)->pluck('id');
        $suppliers = Supplier::with(['user'])->whereIn('user_id',$user)->paginate(10);

        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort_if(Gate::denies('supplier_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Countries::all();

        return view('admin.suppliers.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country ?? '' ,
            'address' => $request->address ?? '',
            'phone' => $request->phone ?? '',
            'gender' => '',
            'password' => Hash::make($request->password) ?? Hash::make('12345678'),
            'user_type' => 2,
            'approved' => 1,
            'verified' => 1,
        ]);

        $fileName = null;
        if($request->has('profile_picture')){
            $file = $request->file('profile_picture');
            $fileName =  time().'.'.$file->getClientOriginalExtension();
            $file->move(storage_path('app/supplier'), $fileName);
        }

        $supplier = Supplier::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
            'phone' => $request->phone,
            'profile_image' => $fileName,
            'company_name' => $request->company,
            'address' => $request->address,
            'destignation' => $request->destignation,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.suppliers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // abort_if(Gate::denies('supplier_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplier = Supplier::find($id);

        return view('admin.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // abort_if(Gate::denies('supplier_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $supplier = Supplier::with(['user'])->where('id',$id)->first();
        $countries = Countries::all();

        return view('admin.suppliers.edit', compact('supplier','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, $id)
    {
        $supplier = Supplier::find($id);
        $user = User::find($supplier->user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country ?? '' ,
            'address' => $request->address ?? '',
            'phone' => $request->phone ?? '',
            'gender' => '',
            'password' => Hash::make($request->password),
            'user_type' => 2,
            'approved' => 1,
            'verified' => 1,
        ]);

        $fileName = null;
        if($request->has('profile_picture')){
            $file = $request->file('profile_picture');
            $fileName =  time().'.'.$file->getClientOriginalExtension();
            $file->move(storage_path('app/supplier'), $fileName);
        }else{
            $fileName = $request->old_profile_picture;
        }

        $supplier->update([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
            'phone' => $request->phone,
            'profile_image' => $fileName,
            'company_name' => $request->company,
            'address' => $request->address,
            'destignation' => $request->destignation,
            'status' => $request->status,
        ]);


        return redirect()->route('admin.suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // abort_if(Gate::denies('supplier_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $supplier = Supplier::find($id);
        $user = User::find($supplier->user_id);
        $user->delete();

        try{
            unlink(storage_path('app/supplier/'.$supplier->profile_image));
        }catch(\Exception $e){}

        $supplier->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        $supplier = Supplier::whereIn('id', request('ids'))->pluck('user_id');
        $users = User::whereIn('id', $supplier)->get();
        foreach($users as $user){
            User::find($user->id)->delete();
        }

        $suppliers = Supplier::whereIn('id', request('ids'))->get();
        foreach($suppliers as $supplier){
            try{
                unlink(storage_path('app/supplier/'.$supplier->profile_image));
            }catch(\Exception $e){}
            $supplier->delete();
        }


        return response(null, Response::HTTP_NO_CONTENT);
    }
}
