<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';

    protected $fillable = ['nickName','mobile','pwd','face_img_b','face_img_m','face_img_s','created_at','updated_at'];
}
