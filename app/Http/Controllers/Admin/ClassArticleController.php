<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\admin\ClassArticleRepository;
use App\Models\ClassCate;
use App\Models\AdviserArticle;


class ClassArticleController extends Controller
{
    public function __construct()
    {

    }
	/**
     * 用户列表

     */
    public function index()
    {
        $classCate = new ClassCate;
        $classCate=$classCate->lists('id','name');


        $adviserArticle = new AdviserArticle;
        $adviserArticle=$adviserArticle->lists('id','cnName');

        return view('admin.class.article.list')->with('classCate',$classCate)->with('adviserArticle',$adviserArticle);
    }







    /**
     * datatable 获取数据

     */
    public function ajaxIndex()
    {
        $data = ClassArticleRepository::ajaxIndex();
        return response()->json($data);
    }
    /**
     * 添加用户视图

     */
    public function create()
    {
        $classCate = new ClassCate;
        $classCate=$classCate->lists('id','name');


        $adviserArticle = new AdviserArticle;
        $adviserArticle=$adviserArticle->lists('id','cnName');




        return view('admin.class.article.create')->with('classCate',$classCate)->with('adviserArticle',$adviserArticle);
    }

    /**
     * 添加用户

     */
    public function store(Request $request)
    {
        ClassArticleRepository::store($request);
        return redirect('admin/classArticle');
    }

    /**
     * 修改用户视图

     */
    public static function edit($id)
    {

        $classArticle=ClassArticleRepository::edit($id);
        $classCate = new ClassCate;
        $classCate=$classCate->lists('id','name');

        $adviserArticle = new AdviserArticle;
        $adviserArticle=$adviserArticle->lists('id','cnName');


        return view('admin.class.article.edit')->with('classCate',$classCate)->with('classArticle',$classArticle)->with('adviserArticle',$adviserArticle);
    }
    /**
     * 修改用户资料

     */
    public function update(request $request,$id)
    {
       ClassArticleRepository::update($request,$id);
        return redirect('admin/classArticle');
    }



    /**
     * 删除用户

     */
    public function destroy($id)
    {
        ClassArticleRepository::destroy($id);
        return redirect('admin/classArticle');
    }


}
