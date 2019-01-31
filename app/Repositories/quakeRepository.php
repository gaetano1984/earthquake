<?php 

	namespace App\Repositories;

	use App\Model\EarthQuake;
	use Illuminate\Support\Facades\DB;

	class quakeRepository{
		public $earthQuake;
		public function __construct(EarthQuake $e){
			$this->earthQuake = $e;
		}
		public function find($id_earthquake){
			$q = Earthquake::where('id_earthquake', $id_earthquake)->get();
			return $q;
		}
		public function findAll($id_earthquake){
			$q = EarthQuake::whereIn('id_earthquake', $id_earthquake)->get();
			return $q;
		}
		public function create($idevent, $time, $location, $magnitude, $latitude, $longitude){
			$e = new Earthquake();
			$e->id_earthquake = $idevent;
			$e->creationTime = $time;
			$e->location = $location;
			$e->magnitude = $magnitude;	
			$e->latitude = $latitude;
			$e->longitude = $longitude;
			$e->save();
		}
		public function recent(){
			$q = $this->earthQuake->recent();
			return $q;
		}
		public function notified($idevent){
			$this->earthQuake->notified($idevent);
		}
		public function search($filter){
			$q = Earthquake::where($filter)->get();
			return $q;
		}
		public function statsNumber(){
			$res = Earthquake::select([\DB::raw('date("creationTime") as data, count(*) as tot')])->groupBy(DB::raw('date("creationTime")'))->orderBy(\DB::raw('date("creationTime")', 'asc'))->get();
			$res = $res->toArray();
			return $res;
		}
		public function statsMagnitude(){
			$res = Earthquake::select(\DB::raw('magnitude, count(*) as tot'))->groupBy('magnitude')->orderBy(\DB::raw('magnitude', 'asc'))->get();
			$res = $res->toArray();
			return $res;
		}
	}

 ?>