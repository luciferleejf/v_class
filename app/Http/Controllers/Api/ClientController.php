<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    private $argv;

    public function __construct(){

        $this->argv = config('app.sms');

    }

    public function sdMessage($mobile)
    {
        $flag=0;
        $params="";
        $verify = rand(1234, 9999);
        $this->argv['content'] = '短信验证码为：'.$verify.'，请勿将验证码提供给他人。';
        $this->argv['mobile']=$mobile;
        foreach ($this->argv as $key=>$value) {
            if ($flag!=0) {
                $params .= "&";
                $flag = 1;
            }
            $params.= $key."="; $params.= urlencode($value);// urlencode($value);
            $flag = 1;
        }

        $url = "http://sms.1xinxi.cn/asmx/smsservice.aspx?".$params; //提交的url地址
        $con= substr( file_get_contents($url), 0, 1 );  //获取信息发送后的状态
        if($con == '0'){
           return $verify;
        }else{
           return false;
        }
    }

	public function index()
	{
		return view('api.client.list');
	}

    public function checkLogin(request $request)
    {
        $data = $request->all();


    }

    public function register(request $request){

        $data = $request->all();

        ClientController::sdMessage('13551838044');
    }




}
