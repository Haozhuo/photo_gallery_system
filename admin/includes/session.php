<?php

class Session{

	private $signed_in = false;
	public $user_id;

	function __construct(){
		//started session
		session_start();
		$this->set_log_in_data();
	}


	private function set_log_in_data(){
		if(isset($_SESSION['user_id'])){
			$this->user_id = $_SESSION['user_id'];
			$this->signed_in = true;
		} else{
			unset($this->user_id);
			$this->signed_in = false;
		}
	}

	public function is_signed_in(){
		return $this->signed_in;
	}

	public function login($user){
		if($user){
			$_SESSION['user_id'] = $user->id;
			$this->user_id = $_SESSION['user_id'];
			$this->signed_in = true;
		}
	}

	public function logout(){
		unset($this->user_id);
		$this->signed_in = false;
		seesion_destroy();
	}

};

$session = new Session();

?>