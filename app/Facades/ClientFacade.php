<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class ClientFacade extends Facade
{

    protected static function getFacadeAccessor(){
        return 'ClientRepository';
    }
}