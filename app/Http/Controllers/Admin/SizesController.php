<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('size_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sizes = Size::all();

        return view('admin.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('size_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $size = Size::create($request->all());

        return redirect()->route('admin.sizes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        abort_if(Gate::denies('size_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.sizes.show', compact('size'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        abort_if(Gate::denies('size_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        $size->update($request->all());

        return redirect()->route('admin.sizes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        abort_if(Gate::denies('size_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $size->delete();

        return back();
    }
}
