<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class AdviserArticleFacade extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor(){
		return 'AdviserArticleRepository';
	}
}