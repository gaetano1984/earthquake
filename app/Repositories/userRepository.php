<?php 

	namespace App\Repositories;

	use App\User;

	class userRepository{
		public $u;
		public function __construct(User $u){
			$this->u = $u;
		}
		public function toNotify(){
			$users = $this->u->toNotify();
			return $users;
		}
		public function updateProfile($user_id, $data){
			$this->u->updateProfile($user_id, $data);
		}
	}

 ?>