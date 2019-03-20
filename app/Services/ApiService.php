<?php 

	namespace App\Services;

	use \App\Repositories\ApiRepository;

	class apiService{
		public $apiRepository;
		public function __construct(ApiRepository $apiRepository){
			$this->apiRepository = $apiRepository;
		}
		public function store($url, $ip, $key, $secret, $enabled){
			$this->apiRepository->store($url, $ip, $key, $secret, $enabled);
		}
		public function getList(){
			$list = $this->apiRepository->paginate();
			return $list;
		}
	}

 ?>