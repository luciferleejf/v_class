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
                $v['actionButton'] = "
				<a href=".url('admin/classArticles'.'/'.$v['id'])." class='btn btn-xs btn-info tooltips'  data-container='body' data-original-title=" . trans('crud.edit') . "  data-placement='top'>
				    <i class='fa fa-search'></i>
				</a>
				<a href=".url('admin/classArticles'.'/'.$v['id'].'/edit')." class='btn btn-xs btn-primary tooltips' data-original-title=" . trans('crud.edit') . "  data-placement=top>
				    <i class='fa fa-pencil'></i>
				</a>
				<a href='javascript:;' onclick='return false' class='btn btn-xs btn-danger tooltips' data-container='body' data-original-title=" . trans('crud.destory') . "  data-placement='top' id='destory'>
                    <i class='fa fa-trash'></i>
                    <form action=".url('admin/classArticles'.$v['id'])." method='POST' name='delete_item' style='display:none'>
                      <input type='hidden' name='_method' value='delete'><input type='hidden' name='_token' value=".csrf_token().">
                    </form>
				</a>";
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
	public static function store($request)
	{
		$classArticle = new ClassArticle;

		$Data = $request->all();
		//密码进行加密


		if ($classArticle->fill($Data)->save()) {
			//自动更新用户权限关系

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

        if(Input::file('weixin_image'))
        {
            $file = Input::file('weixin_image');

        }
        else if(Input::file('face_image')){

            $file = Input::file('face_image');
        }
        else if(Input::file('mp3_image')){

            $file = Input::file('mp3_image');
        }


        $allowed_extensions = ["png", "jpg", "gif",'jpeg','mp3'];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }

        $destinationPath = public_path() . "/uploads/class-img/";

        $extension = $file->getClientOriginalExtension();
        $fileName = time().'.'.$extension;
        $file->move($destinationPath, $fileName);

        $data['result']="/uploads/class-img/".$fileName;

        return $data;
    }


}