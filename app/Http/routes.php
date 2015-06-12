<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::group(array('prefix'=>'admin',"namespace"=>'Admin'),function(){
//    Route::get('/','IndexController@index');
//
//});
//微信接口

Route::group(['namespace' => 'Wechat'], function () {
    Route::any('/wechat_api', 'ApiController@serve');
    Route::get('/', 'IndexController@index');
    Route::get('category', 'IndexController@category');
    Route::get('category/{category_id}', 'IndexController@good_list');
    Route::get('good/{good_id}', 'IndexController@good');
    Route::get('cart', 'IndexController@cart');
    Route::post('cart', 'IndexController@add_cart');
    Route::get('account', 'IndexController@account');
    Route::get('order','IndexController@order');
    Route::get('/order/obligation','IndexController@obligation');
});
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'csrf']], function () {
    Route::get('/', 'IndexController@index');
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/search', 'BrandController@search');
        Route::patch('/sort', 'BrandController@sort');
        Route::delete('/del_all','BrandController@del_all');
    });
    //商品品牌，除去show方法
    Route::resource('brand', 'BrandController', ['except' => ['show']]);
    //商品类型
    Route::resource('type', 'TypeController', ['except' => ['show']]);

    //商品属性，需要加入商品类型的id
    Route::group(['prefix' => 'type/{type_id}'], function () {
        Route:
        delete('del_all', [
            'as' => 'admin.type.{type_id}.attribute.del_all', 'uses' => 'AttributeController@del_all'
        ]);
        Route::resource('attribute', 'AttributeController', ['except' => ['show']]);
        Route::get('attribute/search', [
            'as' => 'admin.type.{type_id}.search', 'uses' => 'AttributeController@search'
        ]);
    });
    Route::resource('category', 'CategoryController', ['except' => ['show']]);
    Route::group(['prefix' => 'good'], function () {
        Route::get('/search', 'GoodController@search');
        Route::patch('/sort', 'GoodController@sort');
        Route::get('/trash', ['as' => 'admin/good/trash', 'uses' => 'GoodController@trash']);
        Route::get('/{good}/restore', ['as' => 'admin/good/restore', 'uses' => 'GoodController@restore']);
        Route::delete('/{good}/force_destroy', ['as' => 'admin/good/force_destroy', 'uses' => 'GoodController@force_destroy']);
    });
    Route::resource('good', 'GoodController', ['except' => ['show']]);
    //评论管理
    Route::resource('comments', 'CommentsController');
    //评论
    Route::patch('/comments/{comments}/reply', [
        'as' => 'admin.comments.reply', 'uses' => 'CommentsController@reply'
    ]);
    //会员管理
    Route::resource('user', 'UserController');
    //物流运费
    Route::resource('express', 'ExpressController');
    //订单管理
    Route::resource('order', 'OrderController');

    //微信管理
    Route::group(['prefix' => 'wechat'], function () {
        Route::get('/get_menu', ['uses' => 'WechatController@get_menu']);
        Route::put('/set_menu', ['uses' => 'WechatController@set_menu']);
        Route::get('/api_config', ['uses' => 'WechatController@api_config']);
        Route::put('/set_config', ['uses' => 'WechatController@set_config']);
    });

});
//Route::get('/','Admin\IndexController@index');

//管理员登陆
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 管理员注册
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//找回密码
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

//重置密码
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


//上传
Route::post('upload', 'UploadController@store');





