<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class ClassArticleFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'ClassArticleRepository';
	}
}