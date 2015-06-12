<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Controllers\Admin\AdminController;

class BrandController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $brands = Brand::orderBy('sort_order')->paginate(config('wyshop.page_size'));
        return view('admin.brand.index', ['brands' => $brands]);
    }

    public function store(Request $request)
    {
//        return $request->all();
        Brand::create($request->all());
        return redirect(route('admin.brand.index'))->with('info', '新增品牌成功~');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $brand_edit = Brand::find($id);
        return view("admin.brand.edit", ['brand_edit' => $brand_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $brand->update($request->all());
        return redirect(route('admin.brand.index'))->with('info', '修改成功~');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Brand::destroy($id);
        return back()->with('info', '删除品牌成功~');
    }

    public function sort(Request $request)
    {
        $brand = Brand::find($request->id);
        $brand->sort_order = $request->sort_order;
        $brand->save();
    }
    public  function search(Request $request)
    {
        $keyword="%".$request->keyword."%";
        $brands = Brand::orderBy('sort_order')->where('name', 'like', $keyword)->paginate(config('wyshop.page_size'));
        return view('admin.brand.index', ['brands' => $brands]);
    }
    public function del_all(Request $request)
    {
        $id = $request->box2;
//        return response()->json($id);
        foreach($id as $k=>$v){
            Brand::destroy($v);
        }
        return 1;
    }
}
