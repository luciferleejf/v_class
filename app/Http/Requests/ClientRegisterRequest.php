<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class ClientRegisterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'mobile' => 'required',
            'verifyCode' => 'required',
            'pwd' => 'required',
        ];
    }
    public function authorize()
    {
        // 只允许登陆用户
        // 返回 \Auth::check();
        // 允许所有用户登入
        return true;
    }
    // 可选: 重写基类方法

    // 可选: 重写基类方法
    public function response()
    {
        // 如果需要自定义在验证失败时的行为, 可以重写这个方法
        // 了解有关基类中这个方法的默认行为,可以查看:
        // https://github.com/laravel/framework/blob/master/src/Illuminate/Foundation/Http/FormRequest.php

        return response()->json("不能为空");


    }



}
