<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdviserArticle extends Model
{




    protected $table = 'adviser_article';

    protected $fillable = ['cid','keyword','description','adviser_img','cnName','enName','sex','area','phone','gold','job','email'];



}
