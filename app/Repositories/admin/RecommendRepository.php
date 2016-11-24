<?php
namespace App\Repositories\admin;
use App\Models\Recommend;
use Carbon\Carbon;
use Flash;
/**
* 用户仓库
*/
class RecommendRepository
{
	/**
	 * datatable获取数据

	 */
	public static function ajaxIndex()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.golbal.list.start')); /*获取开始*/
		$length = request('length', config('admin.golbal.list.length')); ///*获取条数*/

		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/
		
		$img = request('img' ,'');
        $show = request('show' ,'');
        $type = request('type' ,'');
		$sort = request('sort' ,'');

		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

		$recommend = new Recommend;



		/*权限修改时间搜索*/
		if($updated_at_from){
			$uafc = new Carbon($updated_at_from);
            $recommend = $recommend->where('created_at', '>=', getTime($updated_at_from));
		}
		if($updated_at_to){
            $recommend = $recommend->where('created_at', '<=', getTime($updated_at_to, false));
		}

		$count = $recommend->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
            $recommend = $recommend->orderBy($orderName, $orderDir);
		}

        $recommend = $recommend->offset($start)->limit($length);
        $recommends = $recommend->get();

		if ($recommends) {
			foreach ($recommends as &$v) {
                $v['actionButton'] = "
				
				<a href=".url('admin/recommend'.'/'.$v['id'].'/edit')." class='btn btn-xs btn-primary tooltips' data-original-title=" . trans('crud.edit') . "  data-placement=top>
				    <i class='fa fa-pencil'></i>
				</a>
				<a href='javascript:;' num=".$v['id']." onclick='return false' class='btn btn-xs btn-danger tooltips' data-container='body' data-original-title=" . trans('crud.destory') . "  data-placement='top' id='destory'>
                    <i class='fa fa-trash'></i>
                    <form action=".url('admin/recommend'.'/'.$v['id'])." method='POST' name='delete_item".$v['id']."' style='display:none'>
                      <input type='hidden' name='_method' value='delete'><input type='hidden' name='_token' value=".csrf_token().">
                    </form>
				</a>";
			}
		}
		
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $recommends,
		];
	}

	/**
	 * 添加推荐位

	 */
	public static function store($request)
	{
		$recommend = new Recommend;

		$data = $request->all();

		if ($recommend->fill($data)->save()) {

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
        $recommend = new Recommend;

        $recommend = $recommend->find($id);
		if ($recommend) {
            $recommend = $recommend->toArray();

			return $recommend;
		}
		abort(404);
	}
	/**
	 * 修改用户资料

	 */
	public static function update($request,$id)
	{

        $recommend = new Recommend;

        $recommend = $recommend::find($id);
		if ($recommend) {
			if ($recommend->fill($request->all())->save()) {

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
        $recommend = new Recommend;

		$isDelete = $recommend::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.users.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.users.deleted_error'));
		return false;
	}


}