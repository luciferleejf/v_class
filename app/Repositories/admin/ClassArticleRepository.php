<?php
namespace App\Repositories\admin;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Flash;
use App\Models\ClassArticle;
/**
* 用户仓库
*/
class ClassArticleRepository
{
	/**
	 * datatable获取数据

	 */
	public static function  ajaxIndex()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.golbal.list.start')); /*获取开始*/
		$length = request('length', config('admin.golbal.list.length')); ///*获取条数*/

		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/
		
		$name = request('name' ,'');
		$email = request('email' ,'');
		$confirm_email = request('confirm_email' ,'');
		$status = request('status' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

		$classArticle = new ClassArticle;

		/*邮箱名称搜索*/
		if($name){
			if($search_pattern){
                $classArticle = $classArticle->where('name', 'like', $name);
			}else{
                $classArticle = $classArticle->where('name', $name);
			}
		}

		/*权限搜索*/
		if($email){
			if($search_pattern){
                $classArticle = $classArticle->where('email', 'like', $email);
			}else{
                $classArticle = $classArticle->where('email', $email);
			}
		}
		/*验证邮箱搜索*/
		if($confirm_email){
			if($search_pattern){
                $classArticle = $classArticle->where('confirm_email', 'like', $confirm_email);
			}else{
                $classArticle = $classArticle->where('confirm_email', $confirm_email);
			}
		}
		
		/*状态搜索*/
		if ($status) {
            $classArticle = $classArticle->where('status', $status);
		}

		/*权限创建时间搜索*/
		if($created_at_from){
            $classArticle = $classArticle->where('created_at', '>=', getTime($created_at_from));
		}
		if($created_at_to){
            $classArticle = $classArticle->where('created_at', '<=', getTime($created_at_to, false));
		}

		/*权限修改时间搜索*/
		if($updated_at_from){
			$uafc = new Carbon($updated_at_from);
            $classArticle = $classArticle->where('created_at', '>=', getTime($updated_at_from));
		}
		if($updated_at_to){
            $classArticle = $classArticle->where('created_at', '<=', getTime($updated_at_to, false));
		}

		$count = $classArticle->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$user = $classArticle->orderBy($orderName, $orderDir);
		}

        $classArticle = $classArticle->offset($start)->limit($length);
        $classArticles = $classArticle->get();

		if ($classArticles) {
			foreach ($classArticles as &$v) {
				$v['actionButton'] = '123';
			}
		}
		
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $classArticles,
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

    public static function uploadFile()
    {
        $file = Input::file('weixin_image');

        $allowed_extensions = ["png", "jpg", "gif"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }

        $destinationPath = public_path() . "/uploads/class-img/";

        $extension = $file->getClientOriginalExtension();
        $fileName = time().'.'.$extension;
        $file->move($destinationPath, $fileName);

        $data['result']=$destinationPath.''.$fileName;

        return $data;
    }


}