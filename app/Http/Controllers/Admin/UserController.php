<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use UserRepository;
use PermissionRepository;
use RoleRepository;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPermission:'.config('admin.permissions.user.list'), ['only' => ['index', 'ajaxIndex']]);
        $this->middleware('checkPermission:'.config('admin.permissions.user.create'), ['only' => ['create', 'store']]);
        $this->middleware('checkPermission:'.config('admin.permissions.user.edit'), ['only' => ['edit', 'update']]);
        $this->middleware('checkPermission:'.config('admin.global.user.action').',true', ['only' => ['mark']]);
        $this->middleware('checkPermission:'.config('admin.permissions.user.destory'), ['only' => ['destroy']]);
        $this->middleware('checkPermission:'.config('admin.permissions.user.show'), ['only' => ['show']]);
        $this->middleware('checkPermission:'.config('admin.permissions.user.reset'), ['only' => ['changePassword','resetPassword']]);
    }
	/**
     * 用户列表

     */
    public function index()
    {
        return view('admin.user.list');
    }

    /**
     * datatable 获取数据

     */
    public function ajaxIndex()
    {
        $data = UserRepository::ajaxIndex();
        return response()->json($data);
    }
    /**
     * 添加用户视图

     */
    public function create()
    {
        $permissions = PermissionRepository::findPermissionWithArray();
        $roles = RoleRepository::findRoleWithObject();
        return view('admin.user.create')->with(compact(['permissions','roles']));
    }

    /**
     * 添加用户

     */
    public function store(CreateUserRequest $request)
    {
        UserRepository::store($request);
        return redirect('admin/user');
    }

    /**
     * 修改用户视图

     */
    public function edit($id)
    {
        $user = UserRepository::edit($id);
        $roles = RoleRepository::findRoleWithObject();
        $permissions = PermissionRepository::findPermissionWithArray();
        return view('admin.user.edit')->with(compact(['user','permissions','roles']));
    }
    /**
     * 修改用户资料

     */
    public function update(UpdateUserRequest $request,$id)
    {
        UserRepository::update($request,$id);
        return redirect('admin/user');
    }

    /**
     * 修改用户状态

     */
    public function mark($id,$status)
    {
        UserRepository::mark($id,$status);
        return redirect('admin/user');
    }

    /**
     * 删除用户

     */
    public function destroy($id)
    {
        UserRepository::destroy($id);
        return redirect('admin/user');
    }
    /**
     * 查看用户信息

     */
    public function show($id)
    {
        $user = UserRepository::show($id);
        return view('admin.user.show')->with(compact('user'));
    }
    /**
     * 修改用户密码视图

     */
    public function changePassword($id)
    {
        return view('admin.user.reset')->with(compact('id'));
    }

    /**
     * 修改用户密码

     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        UserRepository::resetPassword($request);
        return redirect('admin/user');
    }
}
