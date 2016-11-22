<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UploadController extends Controller
{
    public function __construct()
    {

    }

    public static function article_upload(request $request)
    {
        if ($request->hasFile('upload')) {
            //upload为ckeditor默认的file提交ID
            $file = $request->file('upload');   //从请求数据内容中取出图片的内容
            $allowed_extensions = ["png", "jpg", "gif",'jpeg']; //允许的图片后缀
            if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions))
            {
                return '图片后缀只支持png,jpg,gif,请检查！';
            }
            $destinationPath = public_path() . "/uploads/article-img/";
            $extension = $file->getClientOriginalExtension();
            $fileName = str_random(10) . '.' . $extension;
            $result = $file->move($destinationPath, $fileName);


            $img_url=url('') . '/uploads/article-img/'.$fileName;
            return $img_url;


        }
    }
}
