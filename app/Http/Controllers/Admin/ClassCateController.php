<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use ClassCateRepository;
use App\Http\Requests\ClassCateRequest;

class ClassCateController extends Controller
{
    public function __construct()
    {

    }


    public function index()
    {
        $classCates = ClassCateRepository::index();
        return view('admin.class.cate.list')->with(compact('classCates'));
    }
    /**
     * 获取菜单数据
     */
    public function edit($id)
    {
        $menu = ClassCateRepository::edit($id);
        return response()->json($menu);
    }
    /**
     * 修改菜单
     */
    public function update(ClassCateRequest $request,$id)
    {
        ClassCateRepository::update($request,$id);
        return redirect('admin/classCate');
    }
    /**
     * 添加菜单
     */
    public function store(ClassCateRequest $request)
    {
        ClassCateRepository::store($request);





        return redirect('admin/classCate');
    }
    /**
     * 菜单排序

     */
    public function sort()
    {
        $result = ClassCateRepository::sort();
        return response()->json($result);
    }

    /**
     * 删除菜单

     */
    public function destroy($id)
    {
        ClassCateRepository::destroy($id);
        return redirect('admin/classCate');
    }



}
