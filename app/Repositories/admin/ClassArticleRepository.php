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




		$orders = request('order', []);
		$classArticle = new ClassArticle;
		$count = $classArticle->count();



		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
            $classArticle = $classArticle->orderBy($orderName, $orderDir);
		}

        $classArticle = $classArticle->offset($start)->limit($length);
        $classArticles = $classArticle
                        ->leftJoin('class_cate','class_cate.id','=','class_article.cid')
                        ->leftJoin('adviser_article','adviser_article.id','=','class_article.tid')
                        ->select('class_article.*','class_cate.name','adviser_article.cnName')
                        ->get();



		if ($classArticles) {
			foreach ($classArticles as &$v) {


                if($v['type'] == 0)
                {
                    $v['type']="视频";
                }
                else{
                    $v['type']="音频";
                }


                $v['actionButton'] = "
			
				<a href=".url('admin/classArticle'.'/'.$v['id'].'/edit')." class='btn btn-xs btn-primary tooltips' data-original-title=" . trans('crud.edit') . "  data-placement=top>
				    <i class='fa fa-pencil'></i>
				</a>
				<a href='javascript:;' num=".$v['id']." onclick='return false' class='btn btn-xs btn-danger tooltips' data-container='body' data-original-title=" . trans('crud.destory') . "  data-placement='top' id='destory'>
                    <i class='fa fa-trash'></i>
                    <form action=".url('admin/classArticle/'.$v['id'])." method='POST' name='delete_item".$v['id']."' style='display:none'>
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
	public static function edit($id)
	{


        $classArticle = new ClassArticle;

        $classArticle = $classArticle
            ->leftJoin('class_cate','class_cate.id','=','class_article.cid')
            ->leftJoin('adviser_article','adviser_article.id','=','class_article.tid')
            ->select('class_article.*','class_cate.name','adviser_article.cnName')
            ->find($id);
        if ($classArticle) {
            $classArticle = $classArticle->toArray();
            return $classArticle;
        }
        abort(404);

	}
	/**
	 * 修改用户资料

	 */
	public static function update($request,$id)
	{
        $classArticle = new ClassArticle;

        $classArticle = $classArticle::find($id);
        if ($classArticle) {
            if ($classArticle->fill($request->all())->save()) {

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
	public static function destroy($id)
	{
        $classArticle = new ClassArticle;

        $isDelete = $classArticle::destroy($id);

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