<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\api\ClientRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRegisterRequest;

class ClientController extends Controller
{


    public function login(request $request)
    {
        $message=ClientRepository::login($request);
        return response()->json($message);
    }

    public function getVerify(request $request){
        $message=ClientRepository::sdMessage($request);
        return response()->json($message);
    }


    public function register(Request $request){
        $message=ClientRepository::register($request);
        return response()->json($message);
    }


    public function setDefault(request $request){
        $message=ClientRepository::setDefault($request);
        return response()->json($message);
    }


    public function forgetPassword(request $request){
        $message=ClientRepository::forgetPassword($request);
        return response()->json($message);
    }

    public function resetPassword(request $request){
        $message=ClientRepository::resetPassword($request);
        return response()->json($message);
    }




}
