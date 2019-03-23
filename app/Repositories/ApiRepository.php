<?php  

	namespace App\Repositories;

	use \App\Model\UrlApiEnabled;

	class ApiRepository{
		
		public $u;

		public function __construct(UrlApiEnabled $u){
			$this->u = $u;
		}

		public function store($url, $ip, $key, $secret, $enabled){
			$u = new UrlApiEnabled();
			$u->url = $url;
	        $u->ip_address = $ip;
	        $u->key = $key;
	        $u->secret = $secret;
	        $u->enabled = $enabled;
	        $u->save();
		}

		public function paginate($limit=10){
			return $this->u->paginate(10);
		}

		public function enDisApi($id_api, $status){
			$upd = UrlApiEnabled::where('id', $id_api)->update(['enabled' => $status]);
			return $upd;
		}

	}

?>