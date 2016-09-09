<?php

class Session{

	private $signed_in = false;
	public $user_id;
	public $message;
	public $count;

	function __construct(){
		//started session
		session_start();
		$this->set_log_in_data();
		$this->check_message();
		$this->visitor_count();
	}

	public function visitor_count(){
		if(isset($_SESSION['count'])){
			return $this->count = $_SESSION['count']++;
		}else{
			return $_SESSION['count'] = 1;
		}
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
		session_destroy();
	}

	public function message($msg=""){
		if(!empty($msg)){
			$_SESSION['message'] = $msg;
		} else{
			return $this->message;
		}
	}

	private function check_message(){
		if(isset($_SESSION['message'])){
			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);
		}else{
			$this->message = "";
		}
	}

};

$session = new Session();

?>