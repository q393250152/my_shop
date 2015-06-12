<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Express;

class ExpressController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $express=Express::orderBy('sort_order')->paginate(config('wyshop.page_size'));
        $expresses = config('wyshop.expresses');
        return view('admin.logistics.logistics',['express'=>$express,'expresses'=>$expresses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
//        return $request->all();
        $expresses = config('wyshop.expresses');
        $name = $expresses["$request->key"];
        $data = array_add($request->all(), 'name', $name);
        Express::create($data);
        return back()->with('info','添加成功~');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $exp = Express::find($id);
        $expresses = config('wyshop.expresses');
        return view('admin.Logistics.edit',['exp'=>$exp,'expresses'=>$expresses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $express = Express::find($id);
        $expresses = config('wyshop.expresses');
        $name = $expresses["$request->key"];
        $data = array_add($request->all(), 'name', $name);
        $express->update($data);
        return redirect(route('admin.express.index'))->with('info','修改成功~');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Express::destroy($id);
        return back()->with('info','删除成功~');
    }
}
