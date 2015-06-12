<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        view()->share(['admin' => Auth::user()]);
        //也可不要这个构造方法，直接{{/Auth::user()->name}}
    }

}
