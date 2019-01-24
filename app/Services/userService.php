<?php 

	namespace App\Services;

	use Mail;
	use App\Repositories\userRepository;
	use App\Mail\notifyEarthquakeToUser;
	use App\Repositories\quakeRepository;

	class userService{
		public $quakeRepository;
		public $userRepository;

		public function __construct(userRepository $userRepository, quakeRepository $quakeRepository){
			$this->userRepository = $userRepository;
			$this->quakeRepository = $quakeRepository;
		}

		public function notify($arr_idquake){
			$quake = $this->quakeRepository->findAll($arr_idquake);
			$users = $this->userRepository->toNotify();
			foreach($users as $u){
				Mail::to($u->email)->send(new notifyEarthquakeToUser($quake, $u));
				//come args devo girargli solo gli id_earthquake
				//$this->quakeRepository->notified($quake); 
			}
		}

		public function updateProfile($user_id, $data){
			$this->userRepository->updateProfile($user_id, $data);
		}
	}

 ?>