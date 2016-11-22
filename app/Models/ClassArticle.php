<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClassArticle extends Model
{
    protected $table = 'class_article';

    protected $fillable = ['id','tid','cid','face_img','title','description','type','pre_class','pre_date','url','content','click'];




}
