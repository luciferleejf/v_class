<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $table = 'api';

    protected $fillable = ['type','name','url','parms','parmsDetail','jason','jasonDetail','requestNum','created_at','updated_at'];
}
