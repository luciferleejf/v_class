<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class RecommendFacade extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor(){
		return 'RecommendRepository';
	}
}