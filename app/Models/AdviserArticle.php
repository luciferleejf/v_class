<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdviserArticle extends Model
{
    protected $table = 'adviser_article';

    protected $fillable = ['department','cnName','enName','sex','area','phone','email'];
}
