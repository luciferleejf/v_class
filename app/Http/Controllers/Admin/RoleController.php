<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use RoleRepository;
use App\Http\Requests\RoleRequest;
use PermissionRepository;
class RoleController extends Controller
{	

    public function __construct()
    {
        $this->middleware('checkPermission:'.config('admin.permissions.role.list'), ['only' => ['index', 'ajaxIndex']]);
        $this->middleware('checkPermission:'.config('admin.permissions.role.create'), ['only' => ['create', 'store']]);
        $this->middleware('checkPermission:'.config('admin.permissions.role.edit'), ['only' => ['edit', 'update']]);
        $this->middleware('checkPermission:'.config('admin.global.role.action').',true', ['only' => ['mark']]);
        $this->middleware('checkPermission:'.config('admin.permissions.role.destory'), ['only' => ['destroy']]);
        $this->middleware('checkPermission:'.config('admin.permissions.role.show'), ['only' => ['show']]);
    }
	/**
	 * 角色列表

	 */
    public function index()
    {
    	return view('admin.role.list');
    }

   	/**
   	 * datatable 获取数据

   	 */
    public function ajaxIndex()
    {
    	$data = RoleRepository::ajaxIndex();
    	return response()->json($data);
    }
    /**
     * 添加角色视图

     */
    public function create()
    {
    	$permissions = PermissionRepository::findPermissionWithArray();
    	return view('admin.role.create')->with(compact('permissions'));
    }

    /**
     * 添加角色

     */
    public function store(RoleRequest $request)
    {
    	RoleRepository::store($request);
    	return redirect('admin/role');
    }

    /**
     * 修改角色视图

     */
    public function edit($id)
    {
    	$role = RoleRepository::edit($id);
    	$permissions = PermissionRepository::findPermissionWithArray();
    	return view('admin.role.edit')->with(compact(['role','permissions']));
    }
    /**
     * 修改角色

     */
    public function update(RoleRequest $request,$id)
    {
    	RoleRepository::update($request,$id);
    	return redirect('admin/role');
    }

    /**
     * 修改角色状态

     */
    public function mark($id,$status)
    {
    	RoleRepository::mark($id,$status);
        return redirect('admin/role');
    }

    /**
     * 删除角色

     */
    public function destroy($id)
    {
        RoleRepository::destroy($id);
        return redirect('admin/role');
    }
    /**
     * 查看角色权限

     */
    public function show($id)
    {
    	$permissions = RoleRepository::show($id);
    	return view('admin.role.show')->with(compact('permissions'));
    }
}
