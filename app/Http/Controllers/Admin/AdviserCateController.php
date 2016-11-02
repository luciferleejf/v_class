<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use AdviserCateRepository;
use App\Http\Requests\AdviserCateRequest;

class AdviserCateController extends Controller
{
    public function __construct()
    {

    }

    /**
     * 顾问分类
     */


    public function index()
    {
        $adviserCates = AdviserCateRepository::index();
        return view('admin.adviser.cate.list')->with(compact('adviserCates'));
    }
    /**
     * 获取菜单数据
     */
    public function edit($id)
    {
        $menu = AdviserCateRepository::edit($id);
        return response()->json($menu);
    }
    /**
     * 修改菜单
     */
    public function update(AdviserCateRequest $request,$id)
    {
        AdviserCateRepository::update($request,$id);
        return redirect('admin/adviserCate');
    }
    /**
     * 添加菜单
     */
    public function store(AdviserCateRequest $request)
    {
        AdviserCateRepository::store($request);
        return redirect('admin/adviserCate');
    }
    /**
     * 菜单排序

     */
    public function sort()
    {
        $result = AdviserCateRepository::sort();
        return response()->json($result);
    }

    /**
     * 删除菜单

     */
    public function destroy($id)
    {
        AdviserCateRepository::destroy($id);
        return redirect('admin/adviserCate');
    }



}
