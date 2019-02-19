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
		public function update(){
			echo "update in corso\n";
			\Log::info("update in corso");

			$added = 0;
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

	        foreach($quakes['eventParameters']['event'] as $quake){
	        	$idevent = trim($quake['preferredOriginID']);
	        	$time = $quake['creationInfo']['creationTime'];
	        	$location = $quake['description']['text'];
	        	$new_location = $location;
				
				$check = preg_match('/[0-9]{1,} km [A-Z]{1,2}/', $location, $match);
				if(count($match)>0){
					$new_location = str_replace($match[0], '', $location);
	        		$this->locationService->create($new_location);	
				}
				else{
					$this->locationService->create($new_location);		
				}

				$new_location = $this->locationService->search($new_location);
				var_dump($new_location);

	        	$magnitude = $quake['magnitude']['mag']['value'];
	        	$latitude = trim($quake['origin']['latitude']['value']);
	        	$longitude = trim($quake['origin']['longitude']['value']);
	        	$q = $this->quakeRepository->find($idevent);
	        	$q = $q->toArray();
	        	if(!$q){
	        		$this->quakeRepository->create($idevent, $time, $location, $magnitude, $latitude, $longitude, $new_location[0]['id']);
	        		$new_event[$idevent] = $idevent;
	        		echo "$idevent salvato\n";
	        		$added++;
	        	}
	        }
	        echo "aggiunti $added eventi\n";
	        if($added>0){
	        	$new_event = array_keys($new_event);
	        	echo "sono stati aggiunti $added nuovi eventi\n";
	        	\Log::info("sono stati aggiunti $added nuovi eventi");
	        	$this->userService->notify($new_event);
	        }
	        else{
	        	echo "non è stato aggiunto niente";
	        }
	        echo "update completato\n";
	        \Log::info("update completato\n");
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