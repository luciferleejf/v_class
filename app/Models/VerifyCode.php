<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifyCode extends Model
{
    protected $table = 'verify_code';

    protected $fillable = ['mobile','verifyCode','tag','created_at','updated_at'];
}
