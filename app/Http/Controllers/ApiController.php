<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ApiCreate;

class ApiController extends Controller
{
    //
    public function index(){

    	$user = Auth::user();
    	$api = [];
    	return view('api.index', compact('user', 'api'));
    }

    public function create(){
    	$user = Auth::user();
        $key = 'api_'.date('Ymd');
        $secret = base64_encode(md5(date('Ymd')));
    	return view('api.create', compact('user', 'key', 'secret'));
    }

    public function store(ApiCreate $request){
        $data = $request->all();
        $this->apiService($url, $key, $secret, $enabled);
    }
}
