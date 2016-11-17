<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassCate extends Model
{
    protected $table = 'class_cate';


    protected $fillable = ['id','name','pid','description','sort','status'];






}
