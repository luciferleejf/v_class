<?php
namespace App\Repositories\admin;
use App\Models\AdviserArticle;
use Carbon\Carbon;
use Flash;
/**
* 顾问仓库
*/
class AdviserArticleRepository
{
	/**
	 * datatable获取数据

	 */
	public function ajaxIndex()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.golbal.list.start')); /*获取开始*/
		$length = request('length', config('admin.golbal.list.length')); ///*获取条数*/

		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/

        $department = request('department' ,'');
		$cnName = request('cnName' ,'');
		$enName = request('enName' ,'');
		$area = request('area' ,'');
		$phone = request('phone' ,'');
		$email = request('email' ,'');
		$orders = request('order', []);

        $AdviserArticle = new AdviserArticle;



        /*部门搜索*/
        if($department){
            if($search_pattern){
                $AdviserArticle = $AdviserArticle->where('department', 'like', $department);
            }else{
                $AdviserArticle = $AdviserArticle->where('department', $department);
            }
        }


		/*中文名称搜索*/
		if($cnName){
			if($search_pattern){
                $AdviserArticle = $AdviserArticle->where('cnName', 'like', $cnName);
			}else{
                $AdviserArticle = $AdviserArticle->where('cnName', $cnName);
			}
		}

        /*英文名称搜索*/
        if($enName){
            if($search_pattern){
                $AdviserArticle = $AdviserArticle->where('enName', 'like', $enName);
            }else{
                $AdviserArticle = $AdviserArticle->where('enName', $enName);
            }
        }

        /*地区搜索*/
        if($area){
            if($search_pattern){
                $AdviserArticle = $AdviserArticle->where('area', 'like', $area);
            }else{
                $AdviserArticle = $AdviserArticle->where('area', $area);
            }
        }

        /*电话搜索*/
        if($phone){
            if($search_pattern){
                $AdviserArticle = $AdviserArticle->where('phone', 'like', $phone);
            }else{
                $AdviserArticle = $AdviserArticle->where('phone', $phone);
            }
        }

        /*邮箱搜索*/
        if($email){
            if($search_pattern){
                $AdviserArticle = $AdviserArticle->where('email', 'like', $email);
            }else{
                $AdviserArticle = $AdviserArticle->where('email', $email);
            }
        }



		$count = $AdviserArticle->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
            $AdviserArticle = $AdviserArticle->orderBy($orderName, $orderDir);
		}

        $AdviserArticle = $AdviserArticle->offset($start)->limit($length);
        $AdviserArticles = $AdviserArticle->get();

		if ($AdviserArticles) {
			foreach ($AdviserArticles as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
			}
		}
		
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $AdviserArticles,
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
	public function edit($id)
	{
		$user = User::with(['permission','role'])->find($id);
		if ($user) {
			$userArray = $user->toArray();
			if ($userArray['permission']) {
				$userArray['permission'] = array_column($userArray['permission'],'id');
			}
			if ($userArray['role']) {
				$userArray['role'] = array_column($userArray['role'],'id');
			}
			return $userArray;
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