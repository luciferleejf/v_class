<?php

use Illuminate\Database\Seeder;
use App\Models\ClassArticle;
class ClassArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $classArticle= new ClassArticle;

        $data['cid']=1;
        $data['face_img']="http://on.usaedu.net/uploadfile/2016/1024/20161024022702134.png";
        $data['title']="美国游学出行准备";
        $data['description']="美国 游学 出境 出行 准备";
        $data['type']=1;
        $data['url']="";
        $data['content']="事业发展中心文教顾问，负责出国游学项目以及外籍学生来华游学项目，熟悉美国B1 B2签证申请及赴美游学团操作工作。";
        $classArticle->fill($data)->save();








    }
}
