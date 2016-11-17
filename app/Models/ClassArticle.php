<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassArticle extends Model
{
    protected $table = 'class_article';

    protected $fillable = ['id','cid','face_img','adviser_img','title','description','type','pre_class','pre_date','url','content','click'];


    public function hasOneClassCate()

    {

        return $this->hasOne('class_cate', 'cid', 'id');

    }

}
