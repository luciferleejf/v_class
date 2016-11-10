<?php
return [
	'action' => '操作',
	'id' => 'ID',
	'close' => '关闭',
	'menuLevel' => '顶级菜单',
	'logout' => '退出',
	'user' => [
		'id' => '序号',
		'name' => '用户名',
		'email' => '邮箱',
		'password' => '密码',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'remember_token' => 'token',
		'list' => '用户列表',
		'confirm_email' => '邮箱验证',
		'show' => '查看用户信息',
		'reset' => '修改密码',
		'permission' => '额外权限',
		'confirm' => '已验证',
		'active' => '<span class="label label-success"> 已验证 </span>',
		'audit' => '<span class="label label-warning"> 未验证 </span>',
		'notice' => '<strong>注意!</strong> 当某个角色的用户需要额外权限时添加.',
		'info' => '暂无额外权限',
	],
	'permission' => [
		'id' => '序号',
		'name' => '权限名称',
		'slug' => '权限',
		'description' => '描述',
		'model' => '模型',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'list' => '权限列表'
	],
	'role' => [
		'id' => '序号',
		'name' => '角色名称',
		'slug' => '角色',
		'description' => '描述',
		'level' => '等级',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'list' => '角色列表',
		'permission' => '权限',
		'module' => '模块',
		'show' => '查看角色权限',
	],
	'menu' => [
		'id' => 'ID',
		'name' => '名称',
		'pid' => '一级菜单',
		'language' => '语言',
		'icon' => '图标',
		'slug' => '权限',
		'url' => '地址',
		'description' => '描述',
		'sort' => '排序',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'detail' => '<i class="fa fa-cog"></i> 菜单属性',
		'show' => '查看',
	],
    'adviserArticle' =>[

        'adviserArticle' => '顾问列表',
        'photo' => '头像',
        'department' => '部门',
        'cnName' => '中文名',
        'enName' => '英文名',
        'sex' => '性别',
        'area' => '所属地区',
        'email' => '邮箱',
        'phone' => '电话',

    ],
    'classArticle' =>[

        'cid' => '课程分类',
        'title' => '课程名称',
        'description' => '描述',
        'type' => '课程类型',


    ],

    'adviserCate' =>[
        'detail' => '<i class="fa fa-cloud"></i> 分类属性',

    ],
    'classCate' => [
        'detail' => '<i class="fa fa-cloud"></i> 分类属性'

    ],

    'class' => [
        'detail' => '<i class="fa fa-book"></i> 课程管理'
    ],


	'breadcrumb' => [
		'home' => '<i class="fa fa-home"></i> 主页',
		'permissionList' => '<i class="fa fa-bars"></i> 权限列表',
		'permissionCreate' => '<i class="fa fa-paper-plane-o"></i> 创建权限',
		'permissionEdit' => '<i class="fa fa-pencil"></i> 修改权限',
		'roleList' => '<i class="fa fa-bars"></i> 角色列表',
		'roleCreate' => '<i class="fa fa-user-plus"></i> 创建角色',
		'roleEdit' => '<i class="fa fa-pencil"></i> 修改角色',
		'userList' => '<i class="fa fa-bars"></i> 用户列表',
		'userCreate' => '<i class="fa fa-user-plus"></i> 创建用户',
		'userEdit' => '<i class="fa fa-pencil"></i> 修改用户',
		'userReset' => '<i class="fa fa-lock"></i> 修改密码',
		'userShow' => '<i class="fa fa-user"></i> 用户信息',
		'menuList' => '<i class="fa fa-cogs"></i> 菜单管理',
		'logList' => '<i class="fa fa-cogs"></i> 系统日志',
		'logs' => '<i class="fa fa-navicon"></i> 日志列表',
		'logDetail' => '<i class="fa fa-television"></i> 日志详情',
        'adviser' => '<i class="fa fa-diamond"></i> 顾问管理',
        'adviserCate' => '<i class="fa fa-cloud"></i> 顾问分类',
        'adviserArticle' => '<i class="fa fa-file-text"></i> 顾问列表',
        'classCate' => '<i class="fa fa-cloud"></i> 课程分类',
        'classArticle' => '<i class="fa fa-file-text"></i> 课程列表',
        'appUser' => '<i class="fa fa-male"></i> 用户管理',
        'api' => '<i class="fa fa-code-fork"></i> 接口管理',
	],

    'api' =>[
        'list' => '接口列表',
        'type' => '请求方式',
        'name' => '接口名称',
        'url' => '接口地址',
        'parms' => '参数列表',
        'parmsDetail' => '参数说明',
        'jason' => 'jason列表',
        'jasonDetail' => 'jason说明',
        'requestNum' => '请求次数',

    ],

    'appUser' =>[

        'nickName' => '昵称',
        'mobile' => '手机',
        'face_img_b' => '头像',
        'detail' => '<i class="fa fa-book"></i> 课程管理'
    ],


];