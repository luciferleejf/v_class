<?php

namespace App\Http\Controllers\Admin;
use App\Models\AdviserArticle;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdviserCate;
use AdviserArticleRepository;
use Illuminate\Support\Facades\DB;


use Illuminate\Database\Eloquent;

class AdviserArticleController extends Controller
{
    public function __construct()
    {

    }
	/**
     * 用户列表

     */
    public function index()
    {

        $adviserCate = new AdviserCate;
        $adviserCate=$adviserCate->lists('id','name');



        return view('admin.adviser.article.list')->with('adviserCate',$adviserCate);

    }

    /**
     * datatable 获取数据

     */
    public function ajaxIndex()
    {
        $data = AdviserArticleRepository::ajaxIndex();
        return response()->json($data);
    }




    public function create()
    {
        $adviserCate = new AdviserCate;
        $adviserCate=$adviserCate->lists('id','name');

        return view('admin.adviser.article.create')->with('adviserCate',$adviserCate);
    }

    /**
     * 添加用户

     */
    public function store(request $request)
    {
        AdviserArticleRepository::store($request);
        return redirect('admin/adviserArticle');
    }

    /**
     * 修改视图

     */
    public function edit($id)
    {
        $adviserArticle=AdviserArticleRepository::edit($id);
        $adviserCate = new AdviserCate;
        $adviserCate=$adviserCate->lists('id','name');
        return view('admin.adviser.article.edit')->with('adviserCate',$adviserCate)->with('adviserArticle',$adviserArticle);
    }
    /**
     * 修改资料

     */
    public function update(request $request,$id)
    {
        AdviserArticleRepository::update($request,$id);
        return redirect('admin/adviserArticle');
    }



    /**
     * 删除用户

     */
    public function destroy($id)
    {

        AdviserArticleRepository::destroy($id);
        return redirect('admin/adviserArticle');
    }
    /**
     * 查看用户信息

     */
    public function show($id)
    {
        $adviserArticle = AdviserArticleRepository::show($id);
        return view('admin.adviser.article.show')->with('adviserArticle',$adviserArticle);
    }







}
