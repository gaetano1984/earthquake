<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use Illuminate\Http\Request;
use App\Services\quakeService;
use App\Mail\notifyEarthquakeToUser;
use App\Repositories\quakeRepository;
use Symfony\Component\HttpFoundation\Response;

class QuakeController extends Controller
{
	public $quakeService;
    public $quakeRepository;

	public function __construct(quakeService $quakeService, quakeRepository $quakeRepository){
		$this->quakeService = $quakeService;
        $this->quakeRepository = $quakeRepository;
	}

    public function update(){
    	$res = $this->quakeService->update();
    }

    public function list(Request $request, $limit=10){
        $user = \Auth::user()->toArray();
        $res = $this->quakeService->paginateRecent($limit);
        $obj = compact('user', 'res');
        return view('earthquake.list')->with(compact('user', 'res', 'limit'));
    }

    public function apiList(){
        $res = $this->quakeService->recent();
        return response()->json($res);
    }

    public function apiSearch(Request $request){
        $min = $request->get('min');
        $max = $request->get('max');

        $this->validate($request, [
            'min' => 'required|numeric'
            ,'max' => 'required|numeric'
        ], [
            'min.required' => __('earthquake.validation.min.required')
            ,'min.numeric' => __('earthquake.validation.min.numeric')
            ,'max.required' => __('earthquake.validation.max.required')
            ,'max.numeric' => __('earthquake.validation.max.numeric')             
        ]);

        $res = $this->quakeService->search($min, $max);
        return response()->json($res);
    }

    public function stats(){
        $data = $this->quakeService->statsNumber();

        $arr_date = collect($data)->pluck('data')->toArray();
        $arr_count = collect($data)->pluck('tot')->toArray();

        $data = $this->quakeService->statsMagnitude();

        $arr_magnitude = collect($data)->pluck('magnitude')->toArray();
        $arr_count_b = collect($data)->pluck('tot')->toArray();

        $user = \Auth::user();
        return view('earthquake.stats', compact('user', 'arr_date', 'arr_count', 'arr_magnitude', 'arr_count_b'));
    }
}