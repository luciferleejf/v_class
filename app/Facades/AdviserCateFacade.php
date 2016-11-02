<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class AdviserCateFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'AdviserCateRepository';
	}
}