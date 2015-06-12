<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;

class UploadController extends Controller
{
    //上传文件
    public function store(Request $request)
    {
        if ($request->hasFile('Filedata') and $request->file('Filedata')->isValid()) {

            $result = array();

            //文件类型
            $allow = array('image/jpeg', 'image/png', 'image/gif');
            $mine = $request->file('Filedata')->getMimeType();
            if(!in_array($mine, $allow)) {
                $result['status'] = 0;
                $result['info'] = '文件类型错误，只能上传图片';
                return $result;
            }

            //文件大小判断
            $max_size = 1024*1024*3;
            $size = $request->file('Filedata')->getClientSize();
            if($size>$max_size) {
                $result['status'] = 0;
                $result['info'] = '文件大小不能超过3M';
                return $result;
            }

            //上传文件夹，如果不存在，建立文件夹
            $date = date("Y_m_d");
            $path = getcwd().'/uploads/'.$date;
            if(!is_dir($path)) {
                mkdir($path);
            }

            //生成新文件名
            $extension = $request->file('Filedata')->getClientOriginalExtension();
            $file_name=md5(time().rand(0,9999999)).'.'.$extension;

            $request->file('Filedata')->move($path, $file_name);

            //返回新文件名
            $result['status'] = 1;
            $result['info'] = '/uploads/'.$date.'/'.$file_name;
            return $result;
        }
    }
}
