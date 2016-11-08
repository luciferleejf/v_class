<?php

namespace App\Repositories\api;
use App\Models\VerifyCode;
use App\Models\Client;
use Carbon\Carbon;
use Flash;
/**
* 顾问仓库
*/
class ClientRepository
{
    public static function sdMessage($request)
    {
        $data = $request->all();
        $mobile=$data['mobile'];

        $message=array();
        $argv=config('app.sms');
        $flag=0;
        $params="";
        $verify = rand(1234, 9999);
        $argv['content'] = '短信验证码为：'.$verify.'，请勿将验证码提供给他人。';
        $argv['mobile']=$mobile;
        foreach ($argv as $key=>$value) {
            if ($flag!=0) {
                $params .= "&";

            }
            $params.= $key."=";
            $params.= urlencode($value);// urlencode($value);
            $flag = 1;
        }

        $url = "http://sms.1xinxi.cn/asmx/smsservice.aspx?".$params; //提交的url地址
        $con= substr( file_get_contents($url), 0, 1 );  //获取信息发送后的状态


        if($con == '0'){

            $verifyCode = new VerifyCode;
            $data['mobile']=$mobile;
            $data['verifyCode']=$verify;
            if ($verifyCode->fill($data)->save()) {
                $message['status']="200";
                $message['code']="1";   //所有操作成功
                return $message;
            }
            else{
                $message['status']="400";
                $message['code']="2"; //插入数据库失败
                return $message;
            }


        }else{
            $message['status']="400";
            $message['code']="3"; //短信发送失败
            return $message;
        }
    }



    public static function register($request)
    {
        $client = new Client;
        $verifyCode = new VerifyCode;
        $data = $request->all();


        if($client->where('mobile',$data['mobile'])->first())
        {
            $message['status']="400";
            $message['code']="4"; //手机号已经存在
            return $message;

        }

        $check=$verifyCode->orderBy('created_at','desc')->where('mobile',$data['mobile'])->first();

        if($check['verifyCode']==$data['verifyCode'])
        {
            $data['pwd'] = bcrypt($data['pwd']); //密码进行加密

            $info['mobile']=$data['mobile'];
            $info['pwd'] = $data['pwd'];



            $id=$client->insertGetId($info);
            if ($id) {

                $message['status']="200";
                $message['code']="1"; //注册成功
                $message['id']=$id;
                return $message;
            }
            else{

                $message['status']="400";
                $message['code']="2"; //数据库插入错误
                return $message;
            }

        }
        else
        {
            $message['status']="400";
            $message['code']="3"; //验证码错误
            return $message;
        }
    }


    public static function login($request)
    {
        $data = $request->all();
        $client=new Client;
        $user=$client->where('mobile',$data['mobile'])->first();

        if($user)
        {

            if(password_verify($data['pwd'], $user['pwd']))
            {
                $message['status']="200";
                $message['code']="1"; //登录成功
                $message['id']=$user['id'];
                return $message;
            }
            else
            {
                $message['status']="400";
                $message['code']="2"; //用户名或密码错误
                return $message;

            }
        }else{
            $message['status']="400";
            $message['code']="3"; //用户不存在
            return $message;
        }
    }

    public static function setDefault($request)
    {
        $data = $request->all();

        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $data['img'], $result)) {
            //get the base-64 from data
            $type = $result[2];
            //decode base64 string
            $image = base64_decode(str_replace($result[1], '', $data['img']));

            $picName =  time().'.'.$type;

            $path = public_path() . "/uploads/faceimg/" . $picName;

            file_put_contents($path, $image);

            $info['nickName']=$data['nickName'];
            $info['face_img_b']='/uploads/faceimg/'.$picName;
            $client=new Client;

            if($client->where('id',$data['id'])->update($info))
            {
                $message['status']="200";
                $message['code']="1"; //登录成功
                return $message;

            }
            else{
                $message['status']="400";
                $message['code']="2"; //数据库更新错误
                return $message;
            }
        }
        else{
            $message['status']="400";
            $message['code']="3"; //图片错误
            return $message;
        }
    }

    public static function forgetPassword($request)
    {
        $client=new Client;
        $verifyCode = new VerifyCode;
        $data=$request->all();

        $user=$client->where('mobile',$data['mobile'])->first();
        if($user)
        {
            $check=$verifyCode->orderBy('created_at','desc')->where('mobile',$data['mobile'])->first();

            if($check['verifyCode']==$data['verifyCode'])
            {
                $message['status']="200";
                $message['code']="1"; //成功
                $message['mobile']=$data['mobile'];
                return $message;
            }
            else{
                $message['status']="400";
                $message['code']="2"; //验证码不正确
                return $message;
            }

        }
        else{
            $message['status']="400";
            $message['code']="3"; //手机号不存在
            return $message;
        }
    }

    public static function resetPassword($request)
    {

        $client=new Client;
        $data = $request->all();

        $info['pwd']= bcrypt($data['pwd']);

        if($client->where('mobile',$data['mobile'])->update($info))
        {
            $message['status']="200";
            $message['code']="1"; //修改密码成功
            return $message;

        }
        else{
            $message['status']="400";
            $message['code']="2"; //修改错误
            return $message;
        }

    }


}