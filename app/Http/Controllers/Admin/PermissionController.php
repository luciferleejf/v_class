<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PermissionRepository;
use App\Http\Requests\PermissionRequest;
class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPermission:'.config('admin.permissions.permission.list'), ['only' => ['index', 'ajaxIndex']]);
        $this->middleware('checkPermission:'.config('admin.permissions.permission.create'), ['only' => ['create', 'store']]);
        $this->middleware('checkPermission:'.config('admin.permissions.permission.edit'), ['only' => ['edit', 'update']]);
        $this->middleware('checkPermission:'.config('admin.global.permission.action').',true', ['only' => ['mark']]);
        $this->middleware('checkPermission:'.config('admin.permissions.permission.destory'), ['only' => ['destroy']]);
    }
    public function index()
    {
    	return view('admin.permission.list');
    }

    public function ajaxIndex()
    {
    	$data = PermissionRepository::ajaxIndex();
    	return response()->json($data);
    }
    /**
     * 添加权限视图

     */
    public function create()
    {
    	return view('admin.permission.create');
    }

    /**
     * 添加权限

     */
    public function store(PermissionRequest $request)
    {
    	PermissionRepository::store($request);
    	return redirect('admin/permission');
    }

    /**
     * 修改权限视图

     */
    public function edit($id)
    {
    	$permission = PermissionRepository::edit($id);
    	return view('admin.permission.edit')->with(compact('permission'));
    }
    /**
     * 修改权限

     */
    public function update(PermissionRequest $request,$id)
    {
    	PermissionRepository::update($request,$id);
    	return redirect('admin/permission');
    }

    /**
     * 修改权限状态

     */
    public function mark($id,$status)
    {
    	PermissionRepository::mark($id,$status);
        return redirect('admin/permission');
    }

    /**
     * 删除权限

     */
    public function destroy($id)
    {
        PermissionRepository::destroy($id);
        return redirect('admin/permission');
    }
}
