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
				echo "creao location ".$location."\n";
				$res = $this->locationRepository->create($location);	
			}
			return $res;
		}
	}



 ?>