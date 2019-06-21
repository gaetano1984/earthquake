<?php 

	namespace App\Repositories;

	use App\Model\Location;

	class locationRepository{
		public $location;
		public function __construct(Location $l){
			$this->location = $l;
		}
		public function create($location){
			$l = new Location();
			$l->name = $location;
			$l->save();
		}
		public function search($location){	
			$l = new Location();
			$l = $l->where('name', $location)->get();
			return $l;
		}
		public function distLocation(){
			$l = new Location();
			return $l->distLocation();	
		}
	}

 ?>