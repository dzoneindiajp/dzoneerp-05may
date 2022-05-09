<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
class UnitController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('unit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = Unit::all();

        return view('admin.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('unit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unit = Unit::create($request->all());

        return redirect()->route('admin.units.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        abort_if(Gate::denies('unit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        abort_if(Gate::denies('unit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $unit->update($request->all());

        return redirect()->route('admin.units.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        abort_if(Gate::denies('size_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unit->delete();

        return back();
    }
}
