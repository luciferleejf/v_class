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

        $adviserArticle = new AdviserArticle;



        /*部门搜索*/
        if($department){
            if($search_pattern){
                $adviserArticle = $adviserArticle->where('department', 'like', $department);
            }else{
                $adviserArticle = $adviserArticle->where('department', $department);
            }
        }


		/*中文名称搜索*/
		if($cnName){
			if($search_pattern){
                $adviserArticle = $adviserArticle->where('cnName', 'like', $cnName);
			}else{
                $adviserArticle = $adviserArticle->where('cnName', $cnName);
			}
		}

        /*英文名称搜索*/
        if($enName){
            if($search_pattern){
                $adviserArticle = $adviserArticle->where('enName', 'like', $enName);
            }else{
                $adviserArticle = $adviserArticle->where('enName', $enName);
            }
        }

        /*地区搜索*/
        if($area){
            if($search_pattern){
                $adviserArticle = $adviserArticle->where('area', 'like', $area);
            }else{
                $adviserArticle = $adviserArticle->where('area', $area);
            }
        }

        /*电话搜索*/
        if($phone){
            if($search_pattern){
                $adviserArticle = $adviserArticle->where('phone', 'like', $phone);
            }else{
                $adviserArticle = $adviserArticle->where('phone', $phone);
            }
        }

        /*邮箱搜索*/
        if($email){
            if($search_pattern){
                $adviserArticle = $adviserArticle->where('email', 'like', $email);
            }else{
                $adviserArticle = $adviserArticle->where('email', $email);
            }
        }



		$count = $adviserArticle->count();


        if($orders){
            $orderName = request('columns.' . request('order.0.column') . '.name');
            $orderDir = request('order.0.dir');
            $adviserArticle = $adviserArticle->orderBy($orderName, $orderDir);
        }

        $adviserArticle = $adviserArticle->offset($start)->limit($length);
        $adviserArticles = $adviserArticle
                            ->leftJoin('adviser_cate','adviser_cate.id','=','adviser_article.cid')
                            ->select('adviser_article.*','adviser_cate.name')
                            ->get();




        if ($adviserArticles) {


            foreach ($adviserArticles as &$v) {


                if($v['gold']==0)
                {
                    $v['gold']="普通顾问";
                }
                else
                {
                    $v['gold']="金牌顾问";
                }

                /*<a href=".url('admin/adviserArticle'.'/'.$v['id'])." class='btn btn-xs btn-info tooltips'  data-container='body' data-original-title=" . trans('crud.edit') . "  data-placement='top'>
                                    <i class='fa fa-search'></i>
               </a>*/
                $v['actionButton'] = "
				
				<a href=".url('admin/adviserArticle'.'/'.$v['id'].'/edit')." class='btn btn-xs btn-primary tooltips' data-original-title=" . trans('crud.edit') . "  data-placement=top>
				    <i class='fa fa-pencil'></i>
				</a>
				<a href='javascript:;' num=".$v['id']." onclick='return false' class='btn btn-xs btn-danger tooltips' data-container='body' data-original-title=" . trans('crud.destory') . "  data-placement='top' id='destory'>
                    <i class='fa fa-trash'></i>
                    <form action=".url('admin/adviserArticle'.'/'.$v['id'])." method='POST' name='delete_item".$v['id']."' style='display:none'>
                      <input type='hidden' name='_method' value='delete'><input type='hidden' name='_token' value=".csrf_token().">
                    </form>
				</a>";

            }
        }

        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $adviserArticles,
        ];
	}

	/**
	 * 添加用户

	 */
	public function store($request)
	{
		$adviserArticle = new AdviserArticle;

		$data = $request->all();
		//密码进行加密


		if ($adviserArticle->fill($data)->save()) {

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
        $adviserArticle = new AdviserArticle;

        $adviserArticle = $adviserArticle->leftJoin('adviser_cate','adviser_cate.id','=','adviser_article.cid')->select('adviser_article.*','adviser_cate.name')->find($id);
		if ($adviserArticle) {
            $adviserArticle = $adviserArticle->toArray();
			return $adviserArticle;
		}
		abort(404);
	}
	/**
	 * 修改用户资料

	 */
	public function update($request,$id)
	{

        $adviserArticle = new AdviserArticle;

        $adviserArticle = $adviserArticle::find($id);
		if ($adviserArticle) {
			if ($adviserArticle->fill($request->all())->save()) {

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



        $adviserArticle = new AdviserArticle;

		$isDelete = $adviserArticle::destroy($id);

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







}