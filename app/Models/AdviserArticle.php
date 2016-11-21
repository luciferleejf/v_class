<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdviserArticle extends Model
{
    use ActionAttributeTrait;
    private $action;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.adviserArticle.adviserArticle');
    }


    protected $table = 'adviser_article';

    protected $fillable = ['cid','keyword','description','adviser_img','cnName','enName','sex','area','phone','gold','job','email'];


}
