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
			$q = EarthQuake::where('id_earthquake', $id_earthquake)->get();
			return $q;
		}
		public function findAll($id_earthquake){
			$q = EarthQuake::whereIn('id_earthquake', $id_earthquake)->get();
			return $q;
		}
		public function create($idevent, $time, $location, $magnitude, $latitude, $longitude){
			$e = new EarthQuake();
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
		public function paginateRecent($limit=10){
			$q = $this->earthQuake->paginateRecent($limit);
			return $q;
		}
		public function notified($idevent){
			$this->earthQuake->notified($idevent);
		}
		public function statsNumber($filter = []){
            switch(env('DB_CONNECTION')){
                case 'mysql':
                    $res = EarthQuake::
                    		select([\DB::raw('date_format(creationTime, "%Y-%m-%d") as data, count(*) as tot')]);
                    if(array_key_exists('min_date', $filter) && $filter['min_date']!=null){
						$res = $res->where('creationTime', '>=', $filter['min_date']);
					}
					if(array_key_exists('max_date', $filter) && $filter['max_date']!=null){
						$res = $res->where('creationTime', '<=', $filter['max_date']);
					}
            		$res = $res->groupBy(\DB::raw('date_format(creationTime, "%Y-%m-%d")'))->orderBy(\DB::raw('date_format(creationTime, "%Y-%m-%d")', 'asc'))->get();
                break;
                case 'pgsql':
                    $res = EarthQuake::
                    	select([\DB::raw('date("creationTime") as data, count(*) as tot')]);
                    if(array_key_exists('min_date', $filter) && $filter['min_date']!=null){
						$res = $res->where('creationTime', '>=', $filter['min_date']);
					}
					if(array_key_exists('max_date', $filter) && $filter['max_date']!=null){
						$res = $res->where('creationTime', '<=', $filter['max_date']);
					}
                    $res = $res->groupBy(DB::raw('date("creationTime")'))->orderBy(\DB::raw('date("creationTime")', 'asc'))->get();
                break;
            }
            $res = $res->toArray();
            return $res;
        }
		public function statsMagnitude($filter = []){
			$res = EarthQuake::select(\DB::raw('magnitude, count(*) as tot'));
			if(array_key_exists('min_date', $filter) && $filter['min_date']!=null){
				$res = $res->where('creationTime', '>=', $filter['min_date']);
			}
			if(array_key_exists('max_date', $filter) && $filter['max_date']!=null){
				$res = $res->where('creationTime', '<=', $filter['max_date']);
			}
			$res = $res->groupBy('magnitude')->orderBy(\DB::raw('magnitude', 'asc'))->get();
			$res = $res->toArray();
			return $res;
		}
		public function search($filter){
			$min = intval($filter['min_magnitude']);
			$max = intval($filter['max_magnitude']);
			$q;
			if($min && $max){
                $q = $this->earthQuake::whereBetween('magnitude', [$min, $max]);
			}
			if($min){
                $q = $this->earthQuake::where('magnitude', '>=', $min);    
			}
			if($max){
                $q = $this->earthQuake::where('magnitude', '<=', $max);
			}
            return $q->get();
		}
        
	}

 ?>