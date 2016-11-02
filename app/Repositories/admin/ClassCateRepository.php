<?php
namespace App\Repositories\admin;
use App\Models\ClassCate;
use Cache;
use Flash;
class ClassCateRepository
{
	/**
	 * 获取菜单数据

	 */
	public function index()
	{
		//判断是否缓存menu数据
		if (Cache::has(config('admin.global.cache.classCate'))) {
			return Cache::get(config('admin.global.cache.classCate'));
		}
		$classCateList = $this->setClassCateListCache();
		return $classCateList;
	}
	/**
	 * 递归迭代菜单关系
                  [description]
	 */
	private function sortMenu($classCates,$pid = 0){
		$arr = [];
		foreach($classCates as $k =>  $v){
			if($v['pid'] == $pid){
	            $arr[$k] = $v;
	            $arr[$k]['child'] = self::sortMenu($classCates,$v['id']);
	        }
	    }
		return $arr;
	}
	/**
	 * 缓存菜单数据

	 */
	public function setClassCateListCache()
	{

        $classCates = ClassCate::
            orderBy('sort','desc')
            ->orderBy('id','asc')
            ->get()
            ->toArray();

		if ($classCates) {
            $classCates = $this->sortMenu($classCates);
			//子菜单进行排序
			foreach ($classCates as &$v) {
	    		if ($v['child']) {
	    			$sort = array_column($v['child'],'sort');
	    			arsort($sort);
	    			array_multisort($sort,SORT_DESC,$v['child']);
	    		}
	    	}
			//缓存数据
			Cache::forever(config('admin.global.cache.classCate'), $classCates);
			return $classCates;
		}
		return [];
	}
	/**
	 * 获取菜单数据
              [description]
	 */
	public function edit($id)
	{
		$adviserCate = ClassCate::find($id)->toArray();
		if ($adviserCate) {
            $adviserCate['update'] = url('admin/adviserCate/'.$id);
            $adviserCate['msg'] = trans('alerts.menus.laod_success');
			return $adviserCate;
		}
		abort(404);
	}
	/**
	 * 修改菜单数据

	 */
	public function update($request,$id)
	{
        $adviserCate = ClassCate::find($id);
		if ($adviserCate) {
			$pid = $adviserCate->pid;
			$sort = $adviserCate->sort;
			$isUpdate = $adviserCate->fill($request->all())->save();
			if ($isUpdate) {
				$this->setClassCateListCache();
				Flash::success(trans('alerts.menus.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.menus.updated_error'));
			return false;
		}
		abort(404);
	}
	/**
	 * 添加菜单

	 */
	public function store($request)
	{
        $adviserCate = new ClassCate;
		if ($adviserCate->fill($request->all())->save()) {
			// 菜单发生变化，更新菜单数组
			$this->setClassCateListCache();
			Flash::success(trans('alerts.menus.created_success'));
			return true;
		}
		Flash::error(trans('alerts.menus.created_error'));
		return false;
	}

	/**
	 * 菜单排序

	 */
	public function sort()
	{
		$currentItemId = request('currentItemId',0);
		$itemParentId = request('itemParentId',0);

		if (!$currentItemId) {
			return ['status' => false,'msg' => trans('alerts.menus.currentItem_error')];
		}
		$adviserCate = ClassCate::find($currentItemId);
		if ($adviserCate) {
            $adviserCate->pid = $itemParentId;
			if ($adviserCate->save()) {
				//更新菜单缓存数据
				$this->setClassCateListCache();
				return ['status' => true,'msg' => trans('alerts.menus.updated_success')];
			}
			return ['status' => false,'msg' => trans('alerts.menus.updated_error')];
		}
		abort(404);
	}
	/**
	 * 删除菜单

	 */
	public function destroy($id)
	{
		$isDestroy = ClassCate::destroy($id);
		if ($isDestroy) {
			//更新缓存数据
			$this->setClassCateListCache();
			Flash::success(trans('alerts.menus.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.menus.deleted_error'));
		return false;
	}
}