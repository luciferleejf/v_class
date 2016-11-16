<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\admin\ClassArticleRepository;

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
        return view('admin.class.article.list');
    }



    /*
     * 图片上传
     * */
    public function uploadFile()
    {
        $data = ClassArticleRepository::uploadFile();
        return response()->json($data);
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

        return view('admin.class.article.create');
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
