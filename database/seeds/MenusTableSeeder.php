<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;
class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $index = new Menu;
        $index->name = "控制台";
        $index->pid = 0;
        $index->language = "zh";
        $index->icon = "fa fa-dashboard";
        $index->slug = "admin.systems.index";
        $index->url = "admin";
        $index->description = "后台首页";
        $index->save();

        /**
         * -------------------------------------------------
         * 课程管理
         * -------------------------------------------------
         */

        $class = new Menu;
        $class->name = "课程管理";
        $class->pid = 0;
        $class->language = "zh";
        $class->icon = "fa fa-diamond";
        $class->slug = "admin.systems.class";
        $class->url = "admin/classCate/*,admin/classArticle/*";
        $class->description = "课程管理";
        $class->save();

        $class_categories = new Menu;
        $class_categories->name = "课程分类";
        $class_categories->pid = $class->id;
        $class_categories->language = "zh";
        $class_categories->icon = "fa fa-cloud";
        $class_categories->slug = "admin.class.categories";
        $class_categories->url = "admin/classCate";
        $class_categories->description = "课程分类";
        $class_categories->save();

        $claas_article = new Menu;
        $claas_article->name = "课程列表";
        $claas_article->pid = $class->id;
        $claas_article->language = "zh";
        $claas_article->icon = "fa fa-file-text";
        $claas_article->slug = "admin.class.articles";
        $claas_article->url = "admin/classArticle";
        $claas_article->description = "课程列表";
        $claas_article->save();

        /**
         * -------------------------------------------------
         * 顾问管理
         * -------------------------------------------------
         */

        $adviser = new Menu;
        $adviser->name = "顾问管理";
        $adviser->pid = 0;
        $adviser->language = "zh";
        $adviser->icon = "fa fa-diamond";
        $adviser->slug = "admin.systems.adviser";
        $adviser->url = "admin/adviserCate/*,admin/adviserArticle/*";
        $adviser->description = "课程管理";
        $adviser->save();

        $adviser_categories = new Menu;
        $adviser_categories->name = "顾问分类";
        $adviser_categories->pid = $adviser->id;
        $adviser_categories->language = "zh";
        $adviser_categories->icon = "fa fa-cloud";
        $adviser_categories->slug = "admin.adviser.categories";
        $adviser_categories->url = "admin/adviserCate";
        $adviser_categories->description = "顾问分类";
        $adviser_categories->save();

        $adviser_article = new Menu;
        $adviser_article->name = "顾问列表";
        $adviser_article->pid = $adviser->id;
        $adviser_article->language = "zh";
        $adviser_article->icon = "fa fa-file-text";
        $adviser_article->slug = "admin.adviser.articles";
        $adviser_article->url = "admin/adviserArticle";
        $adviser_article->description = "顾问列表";
        $adviser_article->save();

        /**
         * -------------------------------------------------
         * 用户管理
         * -------------------------------------------------
         */

        $client = new Menu;
        $client->name = "用户管理";
        $client->pid = 0;
        $client->language = "zh";
        $client->icon = "fa fa-male";
        $client->slug = "admin.systems.appUser";
        $client->url = "admin/appUser/";
        $client->description = "用户管理";
        $client->save();


        /**
         * -------------------------------------------------
         * 系统管理
         * -------------------------------------------------
         */

        $system = new Menu;
        $system->name = "系统管理";
        $system->pid = 0;
        $system->language = "zh";
        $system->icon = "fa fa-cog";
        $system->slug = "admin.systems.manage";
        $system->url = "admin/role*,admin/permission*,admin/user*,admin/menu*,admin/log-viewer*";
        $system->description = "系统功能管理";
        $system->save();

        $user = new Menu;
        $user->name = "用户管理";
        $user->pid = $system->id;
        $user->language = "zh";
        $user->icon = "fa fa-users";
        $user->slug = "admin.users.list";
        $user->url = "admin/user";
        $user->description = "显示用户管理";
        $user->save();


        $role = new Menu;
        $role->name = "角色管理";
        $role->pid = $system->id;
        $role->language = "zh";
        $role->icon = "fa fa-male";
        $role->slug = "admin.roles.list";
        $role->url = "admin/role";
        $role->description = "显示角色管理";
        $role->save();


        $permission = new Menu;
        $permission->name = "权限管理";
        $permission->pid = $system->id;
        $permission->language = "zh";
        $permission->icon = "fa fa-paper-plane";
        $permission->slug = "admin.permissions.list";
        $permission->url = "admin/permission";
        $permission->description = "显示权限管理";
        $permission->save();

        $log = new Menu;
        $log->name = "系统日志";
        $log->pid = $system->id;
        $log->language = "zh";
        $log->icon = "fa fa-file-text-o";
        $log->slug = "admin.logs.all";
        $log->url = "admin/log-viewer";
        $log->description = "显示系统日志";
        $log->save();

        $menu = new Menu;
        $menu->name = "菜单管理";
        $menu->pid = $system->id;
        $menu->language = "zh";
        $menu->icon = "fa fa-navicon";
        $menu->slug = "admin.menus.list";
        $menu->url = "admin/menu";
        $menu->description = "显示菜单管理";
        $menu->save();

        

    }
}
