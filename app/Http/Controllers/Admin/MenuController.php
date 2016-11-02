<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use MenuRepository;
use App\Http\Requests\MenuRequest;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPermission:'.config('admin.permissions.menu.list'), ['only' => ['index', 'sort']]);
        $this->middleware('checkPermission:'.config('admin.permissions.menu.create'), ['only' => ['store']]);
        $this->middleware('checkPermission:'.config('admin.permissions.menu.edit'), ['only' => ['edit', 'update']]);
        $this->middleware('checkPermission:'.config('admin.permissions.menu.destory'), ['only' => ['destroy']]);
    }
	/**
	 * 菜单首页
	 */
    public function index()
    {
    	$menus = MenuRepository::index();
    	return view('admin.menu.list')->with(compact('menus'));
    }
    /**
     * 获取菜单数据
     */
    public function edit($id)
    {
    	$menu = MenuRepository::edit($id);
    	return response()->json($menu);
    }
    /**
     * 修改菜单
     */
    public function update(MenuRequest $request,$id)
    {
    	MenuRepository::update($request,$id);
    	return redirect('admin/menu');
    }
    /**
     * 添加菜单
     */
    public function store(MenuRequest $request)
    {
    	MenuRepository::store($request);
    	return redirect('admin/menu');
    }
    /**
     * 菜单排序

     */
    public function sort()
    {
    	$result = MenuRepository::sort();
    	return response()->json($result);
    }

    /**
     * 删除菜单

     */
    public function destroy($id)
    {
    	MenuRepository::destroy($id);
    	return redirect('admin/menu');
    }
}
