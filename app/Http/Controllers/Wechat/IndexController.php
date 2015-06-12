<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;
use App\Models\Category;
use App\Models\Good;
use App\Models\User;
use Overtrue\Wechat\Auth;
use Session;
use App\Models\Cart;
use App\Models\Order;


class IndexController extends Controller
{

    private $app_id;
    private $secret;
    private $user;

    public function __construct()
    {
        $this->app_id = config('wechat.app_id');
        $this->secret = config('wechat.secret');
        $this->user = session()->get('user');
        //初始化用户购物车的数量
        view()->share(['cart_number' => $this->cart_number()]);
        $this->check_login();
    }

    //统计用户购物车商品数量
    private function cart_number()
    {
        return Cart::where('user_id',$this->user->id)->sum('number');
    }

    //获取用户信息
    private function check_login()
    {
        //如果session中没有用户信息
        if (!Session::has('user')) {
//            //获取用户信息
//            $user = User::find(8);
//            session()->put('user', $user);
//            return;
            $auth = new Auth($this->app_id, $this->secret);
            $user_info = $auth->authorize($to = null, $scope = 'snsapi_userinfo', $state = 'STATE');


            $check = User::where("openid", $user_info->openid)->first();

            //如果数据库没有用户记录，存入数据库
            if ($check->count() == 0) {

                $user = User::create([
                    'openid' => $user_info->openid,
                    'sex' => $user_info->sex,
                    'nickname' => $user_info->nickname,
                    'city' => $user_info->city,
                    'province' => $user_info->province,
                    'headimgurl' => $user_info->headimgurl
                ]);

            } else {
                //如果数据库中已经有了当前用户
                $user = $check;
            }

            //用户信息存入session，并跳转到微商城首页
            Session::put('user', $user);
            return back();
        }
    }

    //获取栏目信息
    private function get_categories()
    {
//        Cache::forget('wechat_index_categories');        //清除缓存
        $categories = Cache::rememberForever('wechat_index_categories', function () {
            $categories = Category::with('children')->where('parent_id', '0')->orderBy('parent_id', 'asc')->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
            return $categories;
        });
        return $categories;
    }

    public function index()
    {
        $best_goods = Good::where('best', true)->orderBy('created_at', 'desc')->take(4)->get();
        $hot_goods = Good::where('hot', true)->orderBy('created_at', 'desc')->take(4)->get();
        $new_goods = Good::where('new', true)->orderBy('created_at', 'desc')->take(4)->get();
        return view('wechat.index', ['best_goods' => $best_goods, 'hot_goods' => $hot_goods, 'new_goods' => $new_goods]);
    }

    public function category()
    {
        return view('wechat.category', ['categories' => $this->get_categories()]);
    }

    public function good_list($category_id)
    {
        $category = Category::find($category_id);
        $goods = Good::where('onsale', true)->where('category_id', $category_id)->orderBy('created_at', 'desc')->get();
        return view('wechat.good_list', ['category' => $category, 'goods' => $goods]);
    }

    public function good($good_id)
    {
        $good = Good::with('good_galleries', 'comments.user')->find($good_id);
        return view('wechat.good', ['good' => $good]);

    }
    //添加商品到购物车
    public function add_cart(Request $request)
    {
        //判断购物车，当前商品是否有记录
        $cart = Cart::where('good_id', $request->good_id)->where('user_id', $this->user->id)->first();
        //当前商品库存数
        $number = Good::find($request->good_id)->number;
//        //如果是初次新增到购物车
        if (!$cart) {
            //如果用户提交数大于库存数，提示商品库存不足
            if ($request->num > $number) {
                return response()->json(['status' => 0, 'info' => '商品库存不足']);
            }
            Cart::create(['good_id' => $request->good_id, 'user_id' => $this->user->id, 'number' => $request->num]);
            return response()->json(['status' => 1, 'info' => '恭喜，已添至购物车~', 'cart_number' => $this->cart_number()]);
        }

        //如果购物车已经有该商品的记录
        //购物车里的数量+用户新提交的数量 > 库存数
        $new_num = $cart->number + $request->num;
        if ($new_num > $number) {
            return response()->json(['status' => 0, 'info' => '商品库存不足']);
        }
        //如果库存足够，就把原有的数量+新数量，更新数据库
        $cart->number = $new_num;
        $cart->save();
        //status起一个壮态标志作用，看是否购买成功
        return response()->json(['status' => 1, 'info' => '恭喜，已添至购物车~', 'cart_number' => $this->cart_number()]);
    }

    //购物车
    public function cart()
    {
        $carts = Cart::with('good')->where('user_id', $this->user->id)->get();
        return view('wechat.cart', ['carts' => $carts, 'total_price' => $this->total_price()]);
    }

    //计算总价
    private function total_price()
    {
        $total_price = 0;
        $carts = Cart::with('good')->where('user_id', $this->user->id)->get();
        foreach ($carts as $cart) {
            $total_price += $cart->number * $cart->good->price;
        }
        return $total_price;
    }

    //我的账户
    public function account()
    {
        return view('wechat.account',['user'=>$this->user]);
    }

    //我的订单
    public function order()
    {
        $orders = Order::with('address','order_goods.good')->where('user_id',$this->user->id)->get();
//        return $orders;
        $order_status = config('wyshop.order_status');
        return view('wechat.order',['orders'=>$orders,'order_status'=>$order_status]);
    }
    public function obligation()
    {
        $obligation= Order::with('order_goods.good')->where('user_id',$this->user->id)->where('status',0)->get();
//        $index = array();
        foreach($obligation as $ob){
            $sum =0;
            foreach($ob->order_goods as $k=>$v){
                $sum += $v->good->price*$v->number;
            }
            $obligation["$k"]["xj"] =$sum;
//            array_push($index,$sum);将得出的小计金额压入数组
        }
//        return $obligation;

        return view('wechat.obligation',['obligation'=>$obligation]);
    }


}
