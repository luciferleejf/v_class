<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Data;
use App\Models\Data_cate;
use App\Models\ClassArticle;
use App\Models\ClassCate;

use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {

        $data=new Data();

        $temp=$data->leftJoin('v9_class_data','v9_class_data.id','=','v9_class.id')->get();
        $data_cate=new Data_cate();
        $data_cate=$data_cate->get();


        DB::statement('truncate table class_article');
        DB::statement('truncate table class_cate');



        foreach ($data_cate as $key =>$v)
        {
            $cate['id']=$v['catid'];

            $cate['name']=$v['catname'];

            $classCate=new ClassCate();
            $classCate->fill($cate)->save();
        }


        foreach ($temp as $key=>$v)
        {
            $info['url']="";
            $info['type']="";

            $v['vido']=$v['vido'];
            $url=json_decode($v['vido'],true);

            $info['title'] = $v['title'];
            $info['face_img'] = $v['thumb'];
            $info['description'] = $v['keywords'];
            $info['content']=$v['content'];
            $info['cid']=$v['catid'];

            if($url[0]['url']!="")
            {
                $info['type']=1;
                $info['url']=$url[0]['url'];
            }




            $classArticle=new ClassArticle();
            $classArticle->fill($info)->save();
        }

        return redirect('admin/classArticle');

    }


}
