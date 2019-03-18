<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
    	return view('api.create', compact('user'));
    }
}
