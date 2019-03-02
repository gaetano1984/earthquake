<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use Illuminate\Http\Request;
use App\Services\quakeService;
use App\Exports\EarthQuakeExport;
use App\Services\locationService;
use App\Mail\notifyEarthquakeToUser;
use App\Repositories\quakeRepository;
use Symfony\Component\HttpFoundation\Response;

class QuakeController extends Controller
{
	public $quakeService;
    public $quakeRepository;
    public $locationService;

	public function __construct(quakeService $quakeService, quakeRepository $quakeRepository, locationService $locationService){
		$this->quakeService = $quakeService;
        $this->quakeRepository = $quakeRepository;
        $this->locationService = $locationService;
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

    public function statsFiltered(Request $request){

        $user = \Auth::user();
        $min_date = $request->get('min_date');
        $max_date = $request->get('max_date');
        $mag_min = $request->get('magnitudo_minima');
        $mag_max = $request->get('magnitudo_massima');
        $location_id = $request->get('location');

        $filter = ['min_date' => $min_date, 'max_date' => $max_date, 'mag_min' => $mag_min, 'mag_max' => $mag_max, 'location' => $location_id];
        $data = $this->quakeService->statsNumber($filter);

        $arr_date = collect($data)->pluck('data')->toArray();
        $arr_count = collect($data)->pluck('tot')->toArray();

        $data = $this->quakeService->statsMagnitude($filter);

        $arr_magnitude = collect($data)->pluck('magnitude')->toArray();
        $arr_count_b = collect($data)->pluck('tot')->toArray();

        $location = $this->locationService->distLocation();

        return view('earthquake.stats', compact('user', 'min_date', 'max_date', 'mag_min', 'mag_max', 'arr_date', 'arr_count', 'arr_magnitude', 'arr_count_b', 'location', 'location_id'));
    }

    public function stats(Request $request){
        $min_date = date('Y-m-d', strtotime('-10 days'));
        $max_date = date('Y-m-d');
        $mag_min = 1;
        $mag_max = 10;

        $filter = [
            'min_date' => $min_date
            ,'max_date' => $max_date
            ,'mag_min' => $mag_min
            ,'mag_max' => $mag_max
        ];

        $data = $this->quakeService->statsNumber($filter);

        $arr_date = collect($data)->pluck('data')->toArray();
        $arr_count = collect($data)->pluck('tot')->toArray();

        $data = $this->quakeService->statsMagnitude($filter);

        $arr_magnitude = collect($data)->pluck('magnitude')->toArray();
        $arr_count_b = collect($data)->pluck('tot')->toArray();

        $user = \Auth::user();

        $location = $this->locationService->distLocation();
        
        return view('earthquake.stats', compact('user', 'arr_date', 'mag_min', 'mag_max', 'arr_count', 'arr_magnitude', 'arr_count_b', 'min_date', 'max_date', 'location'));
    }

    public function excelExport(Request $request){
        $filters = $request->all();
        return (new EarthQuakeExport($filters))->download('earthquake.xlsx');
    }
}