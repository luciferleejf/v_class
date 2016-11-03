<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class AdviserArticleFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'AdviserArticleRepository';
	}
}