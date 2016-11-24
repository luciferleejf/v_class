<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data_cate extends Model
{


    protected $connection = 'mysql_vclass';
    protected $table = "v9_category";

    protected $fillable = ['catid','catname'];
}
