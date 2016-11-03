<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use AdviserArticleRepository;

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
        return view('admin.adviser.article.list');
    }

    /**
     * datatable 获取数据

     */
    public function ajaxIndex()
    {
        $data = AdviserArticleRepository::ajaxIndex();
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
        AdviserArticleRepository::store($request);
        return redirect('admin/user');
    }

    /**
     * 修改用户视图

     */
    public function edit($id)
    {
        $user = AdviserArticleRepository::edit($id);
        $roles = RoleRepository::findRoleWithObject();
        $permissions = PermissionRepository::findPermissionWithArray();
        return view('admin.user.edit')->with(compact(['user','permissions','roles']));
    }
    /**
     * 修改用户资料

     */
    public function update(UpdateUserRequest $request,$id)
    {
        AdviserArticleRepository::update($request,$id);
        return redirect('admin/user');
    }

    /**
     * 修改用户状态

     */
    public function mark($id,$status)
    {
        AdviserArticleRepository::mark($id,$status);
        return redirect('admin/user');
    }

    /**
     * 删除用户

     */
    public function destroy($id)
    {
        AdviserArticleRepository::destroy($id);
        return redirect('admin/user');
    }
    /**
     * 查看用户信息

     */
    public function show($id)
    {
        $user = AdviserArticleRepository::show($id);
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
        AdviserArticleRepository::resetPassword($request);
        return redirect('admin/user');
    }
}