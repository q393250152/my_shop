<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Good;
use App\Models\Brand;
use App\Models\Category;
use Cache;
use App\Models\Type;
use App\Models\Good_attr;
use App\Models\Good_gallery;

class GoodController extends AdminController
{
    private function get_categories()
    {
        $categories = Cache::rememberForever('admin_category_categories', function () {
            $categories = Category::orderBy('parent_id', 'asc', 'sort_order', 'asc', 'id', 'asc')->get();
            return tree($categories);
        });
        return $categories;
    }


    public function index()
    {
//        $goods =Good::orderBy('created_at', 'desc')->paginate(config('wyshop.page_size'));
//        return view('admin.good.index', ['goods' => $goods]);
//        public function index()

        //return view('admin.brand');
        $goods = Good::orderBy('sort_order')->paginate(config('wyshop.page_size'));
        return view('admin.good.index', ['goods' => $goods]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $brands = Brand::orderBy('sort_order')->get();
        $categories = $this->get_categories();

        $types = Type::with('attributes')->get();

        return view('admin.good.create', ['brands' => $brands, 'categories' => $categories, 'types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
//        return $request->all();
        //新增商品
        $good = Good::create($request->except(['imgs', 'attr_id_list', 'attr_value_list', 'attr_price_list']));

        //增加属性
        if ($request->attr_id_list) {
            foreach ($request->attr_id_list as $k => $v) {
                $good_attr = new Good_attr;
                $good_attr->good_id = $good->id;
                $good_attr->attr_id = $v;
                $good_attr->attr_value = $request->attr_value_list["$k"];
                $good_attr->attr_price = $request->attr_price_list["$k"];
                $good_attr->save();
            }
        }

        //商品相册
        if ($request->imgs) {
            foreach ($request->imgs as $img) {
                $good_gallery = new Good_gallery();
                $good_gallery->good_id = $good->id;
                $good_gallery->img = $img;
                $good_gallery->save();
            }
        }

        return redirect(route('admin.good.index'))->with('info', '添加商品成功~');
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
        $brands = Brand::orderBy('sort_order')->get();
        $categories = $this->get_categories();
        $types = Type::with('attributes')->get();
        $good = Good::with('good_attrs', 'good_galleries')->find($id);
        return view('admin.good.edit', ['good' => $good, 'brands' => $brands, 'categories' => $categories, 'types' => $types]);
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
        $good = Good::find($id);
        $good->update($request->except(['imgs', 'attr_id_list', 'attr_value_list', 'attr_price_list']));

        //增加属性
        if ($request->attr_id_list) {
            //先删除原有属性
            Good_attr::where('good_id', $id)->delete();
            foreach ($request->attr_id_list as $k => $v) {
                $good_attr = new Good_attr;
                $good_attr->good_id = $good->id;
                $good_attr->attr_id = $v;
                $good_attr->attr_value = $request->attr_value_list["$k"];
                $good_attr->attr_price = $request->attr_price_list["$k"];
                $good_attr->save();
            }
        }

        //商品相册
        if ($request->imgs) {
            foreach ($request->imgs as $img) {
                $good_gallery = new Good_gallery();
                $good_gallery->good_id = $good->id;
                $good_gallery->img = $img;
                $good_gallery->save();
            }
        }

        return redirect(route('admin.good.index'))->with('info', '编辑商品成功~');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Good::destroy($id);
        Good_attr::where('good_id', $id)->delete();
        return back()->with('info', '已放入商品回收站~');
    }

    //商品回收站
    public function trash()
    {
        $goods = Good::onlyTrashed()->paginate(config('wyshop.page_size'));
//        return $goods;
        return view('admin.good.trash', ['goods' => $goods]);
    }

    public function force_destroy($id)
    {
        $goods = Good::withTrashed()->find($id);
        $goods->forceDelete();
        return back()->with('info', '删除成功~');
    }

    public function restore($id)
    {
        $goods = Good::withTrashed()->find($id);
        $goods->restore();
        return back()->with('info', '恢复成功~');
    }
    public function search(Request $request){
        $keyword="%".$request->keyword."%";
        $goods = Good::orderBy('sort_order')->where('name', 'like', $keyword)->paginate(config('wyshop.page_size'));
        return view('admin.good.index', ['goods' => $goods]);

    }
    public function sort(Request $request)
    {
        $good = Good::find($request->id);
        $good->sort_order = $request->sort_order;
        $good->save();
    }
}
