##2016.11.23 composer update
mews/captcha 更新至 `v2.1.4` 验证码问题已经解决

## 安装
1. 下载本项目,然后在项目根目录执行 `composer install`
2. 包安装完成后,复制.env.example 文件为.env
3. 执行 `php artisan key:generate`
4. 迁移数据: `php artisan migrate`  And `php artisan db:seed`

OK,项目已经配置完成，后台地址：example.com/admin，不清楚的可以直接去看 `routes.php` 文件。默认管理员账号：`admin@admin.com` , 密码：`123456` 
如果你是在Linux或Mac下配置的请注意相关目录的权限，这里我就不多说了，enjoy！

## 验证码一直错误问题

如果你的验证码包(mews/captcha)版本是`2.12`,但是登录后台的时候一直出现验证码错误，请在 `vendor\mews\captcha\src\CaptchaServiceProvider.php` 中添加一下代码：

```php
// HTTP routing
if (strpos($this->app->version(), 'Lumen') !== false) {
    //Laravel Lumen
    $this->app->get('captcha[/{config}]', 'Mews\Captcha\LumenCaptchaController@getCaptcha');
} else if (starts_with($this->app->version(), '5.2.') !== false) {
    //Laravel 5.2.x
    $this->app['router']->get('captcha/{config?}', '\Mews\Captcha\CaptchaController@getCaptcha')->middleware('web');
} else {
    //Laravel 5.0.x ~ 5.1.x
    $this->app['router']->get('captcha/{config?}', '\Mews\Captcha\CaptchaController@getCaptcha');
}
```
****