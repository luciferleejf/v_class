<?php
namespace App\Repositories\admin;
use App\Models\Client;
use Carbon\Carbon;
use Flash;
/**
* 用户仓库
*/
class AppUserRepository
{
	/**
	 * datatable获取数据

	 */
	public static function ajaxIndex()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.golbal.list.start')); /*获取开始*/
		$length = request('length', config('admin.golbal.list.length')); ///*获取条数*/

		$search_pattern = true; /*是否启用模糊搜索*/
		
		$nickName = request('nickName' ,'');
		$mobile = request('mobile' ,'');

		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

        $client = new Client;




        /*昵称*/
        if($nickName){
            if($search_pattern){
                $client = $client->where('nickName', 'like', $nickName);
            }else{
                $client = $client->where('nickName', $nickName);
            }
        }


        /*电话*/
        if($mobile){
            if($search_pattern){
                $client = $client->where('mobile', 'like', $mobile);
            }else{
                $client = $client->where('mobile', $mobile);
            }
        }




		/*权限创建时间搜索*/
		if($created_at_from){
            $client = $client->where('created_at', '>=', getTime($created_at_from));
		}
		if($created_at_to){
            $client = $client->where('created_at', '<=', getTime($created_at_to, false));
		}



		$count = $client->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
            $client = $client->orderBy($orderName, $orderDir);
		}

        $client = $client->offset($start)->limit($length);
        $clients = $client->get();

		if ($clients) {

			foreach ($clients as &$v) {
                $v['face_img_b']="<div style='width:100px;margin:auto'><img src={$v['face_img_b']} style=width:100%></div>";
				$v['actionButton'] = "
			 
		
				<a href=".url('admin/appUser'.'/'.$v['id'])."
				class='btn btn-xs btn-info tooltips'  data-container='body' data-original-title=" . trans('crud.edit') . "  data-placement='top'>
				<i class='fa fa-search'></i>
				</a>
				
				
				<a href=".url('admin/appUser'.'/'.$v['id'].'/edit')." 
				class='btn btn-xs btn-primary tooltips' data-original-title=" . trans('crud.edit') . "  data-placement=top>
				<i class='fa fa-pencil'></i>
				</a>
				
				
				
				
				
				
				
				
				";
			}
		}
		

		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $clients,
		];
	}

	/**
	 * 添加用户

	 */
	public function store($request)
	{
		$user = new User;

		$userData = $request->all();
		//密码进行加密
		$userData['password'] = bcrypt($userData['password']);

		if ($user->fill($userData)->save()) {
			//自动更新用户权限关系
			if (isset($userData['permission']) && $userData['permission']) {
				$user->permission()->sync($userData['permission']);
			}
			// 自动更新用户角色关系
			if (isset($userData['role']) && $userData['role']) {
				$user->role()->sync($userData['role']);
			}
			Flash::success(trans('alerts.users.created_success'));
			return true;
		}
		Flash::error(trans('alerts.users.created_error'));
		return false;
	}
	/**
	 * 修改用户视图

	 */
	public static function edit($id)
	{
		$client = Client::find($id);
		if ($client) {
			$clientArray = $client->toArray();

			return $clientArray;
		}
		abort(404);
	}
	/**
	 * 修改用户资料

	 */
	public function update($request,$id)
	{
		$user = User::find($id);
		if ($user) {
			if ($user->fill($request->all())->save()) {
				//自动更新用户权限关系
				if ($request->permission) {
					$user->permission()->sync($request->permission);
				}
				//自动更新用户角色关系
				if ($request->role) {
					$user->role()->sync($request->role);
				}
				Flash::success(trans('alerts.users.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.users.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 修改用户状态

	 */
	public function mark($id,$status)
	{
		$user = User::find($id);
		if ($user) {
			$user->status = $status;
			if ($user->save()) {
				Flash::success(trans('alerts.users.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.users.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 删除角色

	 */
	public function destroy($id)
	{
		$isDelete = User::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.users.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.users.deleted_error'));
		return false;
	}

	/**
	 * 查看角色权限

	 */
	public function show($id)
	{
		$user = User::with(['permission','role'])->find($id)->toArray();

		if ($user['permission']) {
			$permissionArray = [];
			foreach ($user['permission'] as $v) {
				array_set($permissionArray, $v['slug'], ['name' => $v['name'],'desc' => $v['description']]);
			}
			$user['permission'] = $permissionArray;
		}
		return $user;
	}

	public function resetPassword($request)
	{
		$request = $request->all();
		$request['password'] = bcrypt($request['password']);
		$user = User::find($request['id']);
		if ($user) {
			if ($user->fill($request)->save()) {
				Flash::success(trans('alerts.users.reset_success'));
				return true;
			}
			Flash::error(trans('alerts.users.reset_error'));
			return false;
		}
		abort(404);
	}
}