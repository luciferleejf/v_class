<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{


    protected $connection = 'mysql_vclass';
    protected $table = "v9_class";

    protected $fillable = ['catid','title','thumb','keywords','description'];
}
