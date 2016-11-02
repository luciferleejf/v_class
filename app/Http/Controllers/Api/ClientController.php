<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class ClientController extends Controller
{

	public function index()
	{
		return view('api.client.list');
	}

    public function checkLogin()
    {
        echo "123";


    }

}
