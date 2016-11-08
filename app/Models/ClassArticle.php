<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassArticle extends Model
{
    protected $table = 'class_article';

    protected $fillable = ['cid','face_img','title','description','type','url','content'];
}
