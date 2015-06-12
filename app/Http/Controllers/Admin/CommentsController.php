<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Comment;
use Auth;
use App\models\Good;

class CommentsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $comments = Comment::with('good','user')->orderBy("created_at",'desc')->paginate(config('wyshop.page_size'));
        foreach($comments as $k=>$v){
            if(!($v->good)){
                $goods = Good::onlyTrashed()->find($v->good_id);
                unset($v->good);
                $comments["$k"]["good"]=$goods;
            }
        }
        return view('admin.comments.index',['comments'=> $comments]);
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
        $admin = Auth::user();
        $comments = Comment::with('good', 'user')->find($id);
        if(!($comments->good)){
            unset($comments->good);
            $goods = Good::onlyTrashed()->find($comments->good_id);
            $comments["good"]=$goods;
        }
        return view('admin.comments.show',['comments' => $comments, 'admin' => $admin]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Comment::destroy($id);
        return back()->with('info','删除成功~');
    }
    public function reply(Request $request, $id){
        $comment=Comment::find($id);
        $comment->reply=$request->reply;
        $comment->save();
        return back()->with('info','回复成功~');
    }

}
