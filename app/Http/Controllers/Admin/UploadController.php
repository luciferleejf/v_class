<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Stevenyangecho\UEditor;

class UploadController extends UEditor\Controller
{
    public function __construct()
    {

    }


    /*
  * 图片上传
  * */
    public static function uploadFile()
    {

        if(Input::file('weixin_image'))
        {
            $file = Input::file('weixin_image');

        }
        else if(Input::file('face_image')){

            $file = Input::file('face_image');
        }
        else if(Input::file('mp3_image')){

            $file = Input::file('mp3_image');
        }


        $allowed_extensions = ["png", "jpg", "gif",'jpeg','mp3'];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }

        $destinationPath = public_path() . "/uploads/class-img/";

        $extension = $file->getClientOriginalExtension();
        $fileName = time().'.'.$extension;
        $file->move($destinationPath, $fileName);

        $data['result']=url('')."/uploads/class-img/".$fileName;


        return response()->json($data);
    }


    public static function update()
    {

        if(Input::file('weixin_image'))
        {
            $file = Input::file('weixin_image');

        }
        else if(Input::file('face_image')){

            $file = Input::file('face_image');
        }
        else if(Input::file('mp3_image')){

            $file = Input::file('mp3_image');
        }


        $allowed_extensions = ["png", "jpg", "gif",'jpeg','mp3'];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }

        $destinationPath = public_path() . "/uploads/class-img/";

        $extension = $file->getClientOriginalExtension();
        $fileName = time().'.'.$extension;
        $file->move($destinationPath, $fileName);

        $data['result']=url('')."/uploads/class-img/".$fileName;


        return response()->json($data);
    }


}
