<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\admin\RecommendRepository;
use App\Models\Recommend;

class RecommendController extends Controller
{
    public function __construct()
    {

    }
	/**
     * 用户列表

     */
    public function index()
    {
        return view('admin.recommend.index.list');
    }

    /**
     * datatable 获取数据

     */
    public function ajaxIndex()
    {
        $data = RecommendRepository::ajaxIndex();
        return response()->json($data);
    }
    /**
     * 添加用户视图

     */
    public function create()
    {

        return view('admin.recommend.index.create');
    }

    /**
     * 添加用户

     */
    public function store(request $request)
    {
        RecommendRepository::store($request);
        return redirect('admin/recommend');
    }

    /**
     * 修改用户视图

     */
    public function edit($id)
    {

        $recommend = new Recommend;
        $recommend=$recommend->where('id',$id)->first();
        return view('admin.recommend.index.edit')->with('recommend',$recommend);
    }
    /**
     * 修改用户资料

     */
    public function update(request $request,$id)
    {
        RecommendRepository::update($request,$id);
        return redirect('admin/recommend');
    }


    /**
     * 删除用户

     */
    public function destroy($id)
    {
        RecommendRepository::destroy($id);
        return redirect('admin/recommend');
    }

}
