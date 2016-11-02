<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdviserCate extends Model
{
    protected $table = 'adviser_cate';

    protected $fillable = ['name','pid','description','sort','status'];
}
