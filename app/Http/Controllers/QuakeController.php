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

    public function list(){
        $user = \Auth::user()->toArray();
        $res = $this->quakeService->recent();
        $obj = compact('user', 'res');
        return view('earthquake.list')->with(compact('user', 'res'));
    }

    public function apiList(){
        $res = $this->quakeService->recent();
        return response()->json($res);
    }

    public function apiSearch(Request $request){
        $min = $request->get('min');
        $max = $request->get('max');
        $res = $this->quakeService->search($min, $max);
        return $res->toArray();
    }

    public function stats(){
        $data = $this->quakeService->statsNumber();

        $arr_date = collect($data)->pluck('data')->toArray();
        $arr_count = collect($data)->pluck('tot')->toArray();

        $data = $this->quakeService->statsMagnitude();

        $arr_magnitude = collect($data)->pluck('magnitude')->toArray();
        $arr_count_b = collect($data)->pluck('tot')->toArray();

        // $arr_date = array_sort($arr_date);
        // $arr_magnitude = array_sort($arr_magnitude);

        $user = \Auth::user();
        return view('earthquake.stats', compact('user', 'arr_date', 'arr_count', 'arr_magnitude', 'arr_count_b'));
    }
}