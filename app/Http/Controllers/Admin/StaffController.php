<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Http\Requests\SupplierRequest;
use App\Models\Countries;
use App\Models\Role;
use App\Models\Staff;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_if(Gate::denies('staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::where('user_type',3)->pluck('id');
        $staffs = Staff::with(['user'])->paginate(10);

        return view('admin.staffs.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort_if(Gate::denies('staff_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Countries::all();

        return view('admin.staffs.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country ?? '' ,
            'address' => $request->address ?? '',
            'phone' => $request->phone ?? '',
            'gender' => '',
            'password' => Hash::make($request->password) ?? Hash::make('12345678'),
            'user_type' => 3,
            'approved' => 1,
            'verified' => 1,
        ]);

        $fileName = null;
        if($request->has('profile_picture')){
            $file = $request->file('profile_picture');
            $fileName =  time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('staff', $fileName);
        }

        $staff = Staff::create([
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

        return redirect()->route('admin.staffs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // abort_if(Gate::denies('staff_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff = Staff::find($id);

        return view('admin.staffs.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // abort_if(Gate::denies('staff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $staff = Staff::with(['user'])->where('id',$id)->first();
        $countries = Countries::all();

        return view('admin.staffs.edit', compact('staff','countries'));
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
        $staff = Staff::find($id);
        $user = User::find($staff->user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country ?? '' ,
            'address' => $request->address ?? '',
            'phone' => $request->phone ?? '',
            'gender' => '',
            'password' => Hash::make($request->password),
            'user_type' => 3,
            'approved' => 1,
            'verified' => 1,
        ]);

        $fileName = null;
        if($request->has('profile_picture')){
            $file = $request->file('profile_picture');
            $fileName =  time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('staff', $fileName);
        }else{
            $fileName = $request->old_profile_picture;
        }

        $staff->update([
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


        return redirect()->route('admin.staffs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // abort_if(Gate::denies('staff_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $staff = Staff::find($id);
        $user = User::find($staff->user_id);
        $user->delete();

        try{
            unlink(storage_path('app/staff/'.$staff->profile_image));
        }catch(\Exception $e){}

        $staff->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        $staff = Staff::whereIn('id', request('ids'))->pluck('user_id');
        $users = User::whereIn('id', $staff)->get();
        foreach($users as $user){
            User::find($user->id)->delete();
        }

        $staffs = Staff::whereIn('id', request('ids'))->get();
        foreach($staffs as $staff){
            try{
                unlink(storage_path('app/staff/'.$staff->profile_image));
            }catch(\Exception $e){}
            $staff->delete();
        }



        return response(null, Response::HTTP_NO_CONTENT);
    }
}
