<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    //每个评论都属于某一个商品
    public function good()
    {
        return $this->belongsTo('App\Models\Good');
       return $this->posts()->withTrashed()->get();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
