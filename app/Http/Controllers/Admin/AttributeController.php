<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Type;
use App\Models\Attribute;

class AttributeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($type_id)
    {
        $types = Type::all();
        $attributes = Attribute::with('type')->where('type_id', $type_id)->paginate(config('wyshop.page_size'));
        return view('admin.attribute.index', ['types' => $types, 'type_id' => $type_id, 'attributes' => $attributes]);
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
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request, $type_id)
    {
//        $this->validate($request, [
//            'name' => 'required'
//        ]);

        Attribute::create($request->all());
        return redirect(route('admin.type.{type_id}.attribute.index', $request->type_id))->with('info','添加商品类型成功~');
    }

    public function show($id)
    {
        //
    }

    public function edit($type_id, $id)
    {
        $types = Type::all();
        $attribute = Attribute::find($id);
        return view('admin.attribute.edit', ['types' => $types, 'type_id' => $type_id, 'attribute' => $attribute]);
    }

    public function update(Request $request,$type_id,$id)
    {
        $attribute=Attribute::find($id);
        $attribute->update($request->all());
        return redirect(route('admin.type.{type_id}.attribute.index', $request->type_id))->with('info','修改成功~');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($type_id, $id)
    {
//      return $type_id;
        Attribute::destroy($id);
        return back()->with('info','删除成功~');
    }

    public function del_all(Request $request, $type_id)
    {
        // return $request->all();
        Attribute::destroy($request->del_all);
        return 1;
    }
    public  function search(Request $request,$type_id)
    {
        $types = Type::all();
        $keyword="%".$request->keyword."%";
//        return $keyword;
        $attributes = Attribute::with('type')->where('name', 'like', $keyword)->paginate(config('wyshop.page_size'));
//        return $attributes;
        return view('admin.attribute.index', ['types' => $types, 'type_id' => $type_id, 'attributes' => $attributes]);
    }
}
