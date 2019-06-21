<?php 

	namespace App\Services;

	use App\Repositories\locationRepository;

	class locationService{
		public $locationRepository;

		public function __construct(locationRepository $locationRepository){
			$this->locationRepository = $locationRepository;
		}

		public function create($location){
			$res = 1;
			$check = $this->locationRepository->search($location)->toArray();
			if(!$check){
				$res = $this->locationRepository->create($location);	
			}
			return $res;
		}

		public function checkLocation($location){
			$to_create = [];
			foreach ($location as $key => $l) {
				$l_temp = $l['description']['text'];
				$new_location = '';
				$check = preg_match('/[0-9]{1,} km [A-Z]{1,2}/', $l_temp, $match);
				if(count($match)>0){
					$new_location = str_replace($match[0], '', $l_temp);
				}
				else{
					$new_location = $l_temp;
				}
				$new_location = trim($new_location);
				$check = $this->search($new_location);
				if(count($check)==0){
					$to_create[$new_location]=1;	
				}				
			}
			return array_keys($to_create);
		}

		public function search($location){
			$res = $this->locationRepository->search($location)->toArray();
			return $res;
		}

		public function distLocation(){
			$res = $this->locationRepository->distLocation();
			return $res;
		}
	}



 ?>
