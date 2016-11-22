<?php

use Illuminate\Database\Seeder;
use App\Models\Api;
class ApiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $host="http://luciferleejf.eicp.net/vclass/public/api/client/";


        /*发送短信接口*/
        $data[0]['type']="POST";
        $data[0]['name']="发送短信";
        $data[0]['url']=$host."getVerify";
        $data[0]['parms']="{mobile,type}";
        $data[0]['parmsDetail']="{电话,[0-注册,1-找回密码]}";
        $data[0]['jason']="{status,code}";
        $data[0]['jasonDetail']="{[200-成功,400-失败],[1-所有操作成功,2-插入数据失败,3-短信发送失败]}";
        $data[0]['requestNum']=0;


        /*用户登录接口*/
        $data[1]['type']="POST";
        $data[1]['name']="用户登录";
        $data[1]['url']=$host."login";
        $data[1]['parms']="{mobile,pwd}";
        $data[1]['parmsDetail']="{电话,密码}";
        $data[1]['jason']="成功:{status,code,id}</br>其他:{status,code}";
        $data[1]['jasonDetail']="成功:{200-成功,1-所有操作成功,用户id}</br>其他:{400-失败,2-密码错误,3-用户不存在}";
        $data[1]['requestNum']=0;

        /*用户注册接口*/
        $data[2]['type']="POST";
        $data[2]['name']="用户注册";
        $data[2]['url']=$host."register";
        $data[2]['parms']="{mobile,pwd,verifyCode}";
        $data[2]['parmsDetail']="{电话,密码,验证码}";
        $data[2]['jason']="成功:{status,code,id}</br>其他:{status,code}";
        $data[2]['jasonDetail']="成功:{200-成功,1-所有操作成功,用户id}</br>其他:{400-失败,2-插入错误,3-验证码错误,4-手机号已经存在}";
        $data[2]['requestNum']=0;

        /*头像昵称设置接口*/
        $data[3]['type']="POST";
        $data[3]['name']="头像昵称设置";
        $data[3]['url']=$host."setDefault";
        $data[3]['parms']="{id,nickName,img}";
        $data[3]['parmsDetail']="{用户id,用户昵称,图片base64流}";
        $data[3]['jason']="{status,code}";
        $data[3]['jasonDetail']="{[200-成功,400-失败],[1-所有操作成功,2-插入错误,3-图片错误]}";
        $data[3]['requestNum']=0;


        /*忘记密码接口*/
        $data[4]['type']="POST";
        $data[4]['name']="忘记密码";
        $data[4]['url']=$host."forgetPassword";
        $data[4]['parms']="{mobile,verifyCode}";
        $data[4]['parmsDetail']="{手机,验证码}";
        $data[4]['jason']="成功:{status,code,mobile}</br>其他:{status,code}";
        $data[4]['jasonDetail']="成功:{200-成功,1-所有操作成功,用户手机}</br>其他:{400-失败,2-验证码错误,3-手机号不存在}";
        $data[4]['requestNum']=0;

        /*重置密码接口*/
        $data[5]['type']="POST";
        $data[5]['name']="重置密码";
        $data[5]['url']=$host."resetPassword";
        $data[5]['parms']="{mobile,pwd}";
        $data[5]['parmsDetail']="{手机,密码}";
        $data[5]['jason']="{status,code}";
        $data[5]['jasonDetail']="{[200-成功,400-失败],[1-成功,2-失败]}";
        $data[5]['requestNum']=0;

        /*首页数据*/
        $data[6]['type']="GET";
        $data[6]['name']="首页数据";
        $data[6]['url']=$host."getIndex";
        $data[6]['parms']="{无}";
        $data[6]['parmsDetail']="{无}";
        $data[6]['jason']="{data}";
        $data[6]['jasonDetail']="{data.preClass-推荐课程,data.hotClass-热门课程}";
        $data[6]['requestNum']=0;

        /*顾问数据*/

        $data[7]['type']="GET";
        $data[7]['name']="顾问数据";
        $data[7]['url']=$host."getAdviser";
        $data[7]['parms']="{无}";
        $data[7]['parmsDetail']="{无}";
        $data[7]['jason']="{data}";
        $data[7]['jasonDetail']="{data.goldAdviser-金牌顾问,data.moreAdviser-更多顾问}";
        $data[7]['requestNum']=0;

        /*课程分类*/

        $data[8]['type']="GET";
        $data[8]['name']="课程分类";
        $data[8]['url']=$host."getClassCate";
        $data[8]['parms']="{无}";
        $data[8]['parmsDetail']="{无}";
        $data[8]['jason']="{data}";
        $data[8]['jasonDetail']="{data.classCate-课程分类}";
        $data[8]['requestNum']=0;


        /*课程详情*/

        $data[9]['type']="POST";
        $data[9]['name']="课程详情";
        $data[9]['url']=$host."classDetail";
        $data[9]['parms']="{id}";
        $data[9]['parmsDetail']="{课程id}";
        $data[9]['jason']="{data}";
        $data[9]['jasonDetail']="{data-数据课程顾问相关信息}";
        $data[9]['requestNum']=0;




        foreach ($data as $value)
        {
            $api= new Api;
            $api->fill($value)->save();
        }








    }
}
