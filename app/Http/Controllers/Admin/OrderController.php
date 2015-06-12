<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Order;
use App\models\Good;

class OrderController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = Order::with('address')->orderBy('created_at', 'desc')->paginate(config('wyshop.page_size'));
//        return $orders;
        $order_status = config('wyshop.order_status');
        return view('admin.order.index', ['orders' => $orders, 'order_status' => $order_status]);
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
        //
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
        $order = Order::with('address', 'express', 'user', 'order_goods.good')->find($id);
        foreach($order->order_goods as $k=>$v){
           if(!($v->good)){
               unset($v->good);
               $goods = Good::onlyTrashed()->find($v->good_id);
               $order->order_goods["$k"]["good"]=$goods;
               }
        }
        $order_status = config('wyshop.order_status');
        return view('admin.order.edit', ['order' => $order,'order_status'=>$order_status]);
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
        $order =Order::find($id);
        $order->express_code =$request->express_code;
        if ($order->status==1){
            $order->status=2;
        }
        $order->save();
        return back()->with('info','订单号修改成功~');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
