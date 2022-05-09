<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\Countries;
use App\Models\User;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_if(Gate::denies('staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::where('user_type', 3)->pluck('id');
        $vendors = Vendor::with(['user'])->paginate(10);

        return view('admin.vendors.index', compact('vendors'));
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

        return view('admin.vendors.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country ?? '',
            'address' => $request->address ?? '',
            'phone' => $request->phone ?? '',
            'gender' => '',
            'password' => Hash::make($request->password) ?? Hash::make('12345678'),
            'user_type' => 3,
            'approved' => 1,
            'verified' => 1,
        ]);

        $fileName = null;
        if ($request->has('profile_picture')) {
            $file = $request->file('profile_picture');
            $fileName =  time() . '.' . $file->getClientOriginalExtension();
            // $file->storeAs('vendors', $fileName);
            $file->move(public_path('app/vendors/'), $fileName);

        }

        $vendor = Vendor::create([
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

        return redirect()->route('admin.vendors.index');
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

        $vendor = Vendor::find($id);

        return view('admin.vendors.show', compact('vendor'));
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
        $vendor = Vendor::with(['user'])->where('id', $id)->first();
        $countries = Countries::all();

        return view('admin.vendors.edit', compact('vendor', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, $id)
    {
        $vendor = Vendor::find($id);

        $user = User::find($vendor->user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country ?? '',
            'address' => $request->address ?? '',
            'phone' => $request->phone ?? '',
            'gender' => '',
            'password' => Hash::make($request->password),
            'user_type' => 3,
            'approved' => 1,
            'verified' => 1,
        ]);

        $fileName = null;
        if ($request->has('profile_picture')) {
            $file = $request->file('profile_picture');
            try {
                // unlink(storage_path('app/vendors/' . $request->old_profile_picture));
                unlink(public_path('app/vendors/' . $request->old_profile_picture));
            } catch (Exception $e) {
            }

            $fileName =  time() . '.' . $file->getClientOriginalExtension();
            // $file->storeAs('vendors', $fileName);
            $file->move(public_path('app/vendors/'), $fileName);

        } else {
            $fileName = $request->old_profile_picture;
        }

        $vendor->update([
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
        return redirect()->route('admin.vendors.index');
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
        $vendor = Vendor::find($id);
        $user = User::find($vendor->user_id);
        $user->forceDelete();

        try {
            unlink(storage_path('app/vendors/' . $vendor->profile_image));
        } catch (\Exception $e) {
        }

        $vendor->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        $vendor = Vendor::whereIn('id', request('ids'))->pluck('user_id');
        $users = User::whereIn('id', $vendor)->get();
        foreach ($users as $user) {
            User::find($user->id)->forceDelete();
        }

        $vendors = Vendor::whereIn('id', request('ids'))->get();
        foreach ($vendors as $vendor) {
            try {
                // unlink(storage_path('app/vendors/' . $vendor->profile_image));
                unlink(public_path('app/vendors/' . $vendor->profile_image));
            } catch (\Exception $e) {
            }
            $vendor->delete();
        }
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
