<?php 

	namespace App\Services;

	use GuzzleHttp\Client;
	use App\Model\Earthquake;
	use App\Services\userService;
	use App\Services\locationService;
	use App\Repositories\quakeRepository;

	class quakeService {
		public $quakeRepository;
		public $userService;
		public $locationService;
		public function __construct(quakeRepository $quakeRepository, userService $userService, locationService $locationService){
			$this->quakeRepository = $quakeRepository;
			$this->userService = $userService;
			$this->locationService = $locationService;
		}
		
		public function retrieveQuakeList(){
			$new_event = [];

			$day = date('Y-m-d', strtotime('-100 days'));
			$day_e = date('Y-m-d');
			$hour = date('H:i:s');
			$start_time = $day.'T'.$hour;
			$end_time = $day_e.'T'.$hour;

	        $url = config('earthquake.rss_url');
	        $min_mg = 2;
	        $max_mg = 9;

	        $client = new Client();

	        $res = $client->request(
	            'GET'
	            ,$url
	            ,[
	                'query' => [
	                    'starttime' => $start_time
	                    ,'endtime' => $end_time
	                    ,'minmag' => $min_mg
	                    ,'maxmag' => $max_mg
	                ]
	            ]
	        );
	        if($res->getStatusCode()==204){
	        	//non è stato trovato nessun evento
	        	echo "non è stato trovato alcun evento";
	        	\Log::info("non è stato trovato alcun evento");
	        	return;
		    }

	        $quakes = $res->getBody()->getContents();
	        $quakes = simplexml_load_string($quakes);
	        $quakes = json_decode(json_encode($quakes),TRUE);
	        return $quakes;
		}

		public function getQuakeToSave($quakes){
			$to_create = [];
			foreach($quakes['eventParameters']['event'] as $quake){
				$idevent = trim($quake['preferredOriginID']);
				$q = $this->quakeRepository->find($idevent);
	        	$q = $q->toArray();
	        	if(!$q){
	        		array_push($to_create, $quake);
	        	}
			}
			return $to_create;
		}

		public function saveQuake($quake){
			$idevent = trim($quake['preferredOriginID']);
        	$time = $quake['creationInfo']['creationTime'];
        	$location = $quake['description']['text'];
        	$new_location = $this->getLocation($location);
			$new_location = $this->locationService->search($new_location);

			$magnitude = $quake['magnitude']['mag']['value'];
        	$latitude = trim($quake['origin']['latitude']['value']);
        	$longitude = trim($quake['origin']['longitude']['value']);

        	$this->quakeRepository->create($idevent, $time, $location, $magnitude, $latitude, $longitude, $new_location[0]['id']);

        	$table_row = [date('Y-m-d', strtotime($time)), $location, $magnitude, $latitude, $longitude];
        	return $table_row;
		}

		public function getLocation($l){
			$check = preg_match('/[0-9]{1,} km [A-Z]{1,2}/', $l, $match);
			$new_location = "";
			if(count($match)>0){
				$new_location = str_replace($match[0], '', $l);
			}
			else{
				$new_location = $l;
			}
			$new_location = trim($new_location);
			return $new_location;
		}

		public function recent(){
			$quake = $this->quakeRepository->recent();
			return $quake;
		}

		public function paginateRecent($limit=10){
			$quake = $this->quakeRepository->paginateRecent($limit);
			return $quake;
		}

		public function search($min=1, $max=9){
			$filter = [
				'min_magnitude' => $min
				,'max_magnitude' => $max
			];
			$quake = $this->quakeRepository->search($filter);
			return $quake;
		}

		public function statsNumber($filter = []){
			$data = $this->quakeRepository->statsNumber($filter);
			return $data;
		}

		public function statsMagnitude($filter = []){
			$data = $this->quakeRepository->statsMagnitude($filter);
			return $data;
		}
	}

 ?>