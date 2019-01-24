<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\updateProfile;
use App\Services\userService;

class UserController extends Controller
{
    //
    public $userService;
    public function __construct(userService $userService){
        $this->userService = $userService;
    }
    public function profile(){
    	$user = \Auth::user()->toArray();
    	return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request){
    	$data = $request->except('_token', 'magnitudo');
        if($request->has('enable_notify')){
            $data['enable_notify']=1;
        }
        else{
            $data['enable_notify']=0;
        }
        $user = \Auth::user();
        $this->userService->updateProfile($user->id, $data);
        return view('user.update_ok', compact('user'));
    }
}
