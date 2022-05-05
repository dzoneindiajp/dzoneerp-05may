<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class SubcategoryController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('subcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subcat = Category::where('parent_id', "!=", "")
                    ->orderby('id', 'desc')
                    ->get();
        return view('admin.subcategories.index', compact('subcat'));
    }


    public function create()
    {
        abort_if(Gate::denies('subcategory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cat = Category::where(['parent_id' => 0])
                    ->orderby('id', 'desc')
                    ->get();
        return view('admin.subcategories.create',compact('cat'));
    }


    public function store(Request $request)
    {
        abort_if(Gate::denies('subcategories_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $cat = Category::create($request->all());

        return redirect()->route('admin.subcategory.index');
    }

    public function show(Subcategory $subcategory)
    {
      abort_if(Gate::denies('subcategory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subcategories.show', compact('subcategory'));
    }


    public function edit(SubCategory $subcategory)
    {
        abort_if(Gate::denies('subcategory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cat = Category::where(['parent_id' => 0])
        ->orderby('id', 'desc')
        ->get();
        return view('admin.subcategories.edit',compact('subcategory','cat'));
    }


    public function update(Request $request, Subcategory $subcategory)
    {
        abort_if(Gate::denies('subcategory_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subcategory->update($request->all());
        return redirect()->route('admin.subcategory.index');
    }


    public function destroy(Subcategory $subcategory)
    {
        abort_if(Gate::denies('subcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subcategory->delete();

        return back();
    }
}
