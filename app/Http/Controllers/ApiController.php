<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ApiCreate;
use App\Services\ApiService;

class ApiController extends Controller
{
    //
    public $apiService;

    public function __construct(ApiService $apiService){
        $this->apiService = $apiService;
    }

    public function index(){
    	$user = Auth::user();
    	$api = $this->apiService->getList();
    	return view('api.index', compact('user', 'api'));
    }

    public function create(){
    	$user = Auth::user();
        $key = 'api_'.date('Ymd');
        $secret = base64_encode(md5(date('Ymd')));
    	return view('api.create', compact('user', 'key', 'secret'));
    }

    public function store(ApiCreate $request){
        $user = Auth::user();
        $data = $request->all();
        $url = $data['url'];
        $ip = $data['ip'];
        $key = $data['key'];
        $secret = $data['secret'];
        $enabled = $data['enabled'];
        $this->apiService->store($url, $ip, $key, $secret, $enabled);
        return view('api.created_ok', compact('user'));
    }

    public function enDisApi(Request $request){
        $user = Auth::user();
        $status = $request->get('status');
        $id_api = $request->get('id_api');
        $upd = $this->apiService->enDisApi($id_api, $status);
        return view('api.update_ok', compact('user'));
    }
}
