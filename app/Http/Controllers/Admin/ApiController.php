<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Api;

class ApiController extends Controller
{
    public function __construct()
    {

    }
	/**
     * 用户列表

     */
    public function index()
    {
        return view('admin.api.list');
    }

    /**
     * datatable 获取数据

     */
    public function ajaxIndex()
    {


        $draw = request('draw', 1);/*获取请求次数*/
        $start = request('start', config('admin.golbal.list.start')); /*获取开始*/
        $length = request('length', config('admin.golbal.list.length')); ///*获取条数*/
        $orders = request('order', []);

        $api = new Api;
        $count = $api->count();


        if ($orders) {
            $orderName = request('columns.' . request('order.0.column') . '.name');
            $orderDir = request('order.0.dir');
            $api = $api->orderBy($orderName, $orderDir);
        }

        $api = $api->offset($start)->limit($length);
        $apis = $api->get();


        $data['draw']=$draw;
        $data['recordsTotal']=$count;
        $data['recordsFiltered']=$count;
        $data['data']=$apis;


        return response()->json($data);
    }

}
