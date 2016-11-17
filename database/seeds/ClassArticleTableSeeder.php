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


        $data[0]['cid']=1;
        $data[0]['face_img']="http://on.usaedu.net/uploadfile/2016/1024/20161024022702134.png";
        $data[0]['title']="美国游学出行准备";
        $data[0]['description']="美国 游学 出境 出行 准备";
        $data[0]['type']=1;
        $data[0]['url']="";
        $data[0]['content']="事业发展中心文教顾问，负责出国游学项目以及外籍学生来华游学项目，熟悉美国B1 B2签证申请及赴美游学团操作工作。";


        $data[1]['cid']=1;
        $data[1]['face_img']="http://www.usaedu.net/statics/index/nanjing/images/Johnny.png";
        $data[1]['title']="阿射yts";
        $data[1]['description']="毕竟yts";
        $data[1]['type']=1;
        $data[1]['url']="";
        $data[1]['content']="事业发展中心文教顾问，负责出国游学项目以及外籍学生来华游学项目，熟悉美国B1 B2签证申请及赴美游学团操作工作。";


        $data[2]['cid']=1;
        $data[2]['face_img']="http://www.usaedu.net/statics/index/nanjing/images/Johnny.png";
        $data[2]['title']="协议龙";
        $data[2]['description']="毕竟协议龙";
        $data[2]['pre_class']=1;
        $data[2]['type']=1;
        $data[2]['url']="";
        $data[2]['content']="事业发展中心文教顾问，负责出国游学项目以及外籍学生来华游学项目，熟悉美国B1 B2签证申请及赴美游学团操作工作。";



        $data[3]['cid']=1;
        $data[3]['face_img']="http://on.usaedu.net/uploadfile/2016/1024/20161024022702134.png";
        $data[3]['title']="fsdfsdf";
        $data[3]['description']="发生的发生大幅度";
        $data[3]['pre_class']=1;
        $data[3]['type']=1;
        $data[3]['url']="";
        $data[3]['content']="事业发展中心文教顾问，负责出国游学项目以及外籍学生来华游学项目，熟悉美国B1 B2签证申请及赴美游学团操作工作。";


        foreach ($data as $value)
        {
            $classArticle= new ClassArticle;
            $classArticle->fill($value)->save();
        }





    }
}
