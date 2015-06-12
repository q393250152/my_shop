<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use Cache;
use App\Models\Category;
use App\Models\Type;
use App\Models\Attribute;

class CategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    //获取栏目信息
    private function get_categories()
    {
        $categories = Cache::rememberForever('admin_category_categories', function () {
            $categories = Category::orderBy('parent_id', 'asc')->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
            return tree($categories);
        });
        return $categories;
    }

    public function index()
    {
        //has判断缓存是否存在，如果不存在
        //        if (!Cache::has('admin_category_categories')) {
//            $categories = $this->get_categories();
        //永久保存对象到缓存中
//            Cache::forever('admin_category_categories', $categories);
//        } else {
        //从缓存中取得对象
//            $categories = Cache::get('admin_category_categories');
//        }

        //查询栏目，并存入缓存
        $categories = $this->get_categories();
        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $attribute = Attribute::with('type')->get();
//        return $attribute;
        $categories = $this->get_categories();


        $types = Type::with("attributes")->get();

//        $categories = Category::all();
        return view('admin.category.create', ['categories' => $categories, 'types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        Cache::forget('admin_category_categories');        //清除缓存
        $filter_attr = serialize(array_unique($request->filter_attr));     //数组去重复, 序列化
//        $filter_attr=array_unique($request->filter_attr);

        //数组合并，两种方法都可以用
        //$category = array_merge($request->except('filter_attr'), ['filter_attr' => $filter_attr]);
        $category = array_add($request->except('filter_attr'), 'filter_attr', $filter_attr);
        Category::create($category);
//
        return redirect(route('admin.category.index'))->with('info', '添加分类成功');
    }

    public function edit($id)
    {
        $categories=$this->get_categories();
        $types = Type::with("attributes")->get();
        $category = Category::find($id);
        //将筛选数据重新插回当前栏目中
        $category->filter_attr = Attribute::with('type.attributes')->whereIn('id', unserialize($category->filter_attr))->get();

        return view('admin.category.edit',['category' => $category, 'categories' => $categories, 'types'=>$types]);
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
        Cache::forget('admin_category_categories');
        $category = Category::find($id);
        if($request->filter_attr!=''){
            $filter_attr = serialize(array_unique($request->filter_attr));     //数组去重复, 序列化
            $data = array_add($request->except('filter_attr'), 'filter_attr', $filter_attr);
        }else{
            $filter_attr='';
            $data = array_add($request->except('filter_attr'), 'filter_attr', $filter_attr);
        }


//        $filter_attr = serialize(array_unique($request->filter_attr));     //数组去重复, 序列化
//        $data = array_add($request->except('filter_attr'), 'filter_attr', $filter_attr);

        $category->update($data);
        return redirect(route('admin.category.index'))->with('info', '编辑成功~');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Cache::forget('admin_category_categories');
        Category::destroy($id);
        return back()->with('info', '删除分类成功');
    }
}
