<?php

class User extends Db_object{
	protected static $db_table = "users";
	protected static $db_table_fields = array('username','password','first_name','last_name','user_image');
	public $id;
	public $username;
	public $first_name;
	public $last_name;
	public $password;
	public $user_image;
	public $upload_directory = "images";
	public $image_placeholder = "http://placehold.it/200x100";
	private $salt = "$2a$07$usesomesillystringforsalt$";

	//BLOW_FISH salt
	public function crypt_password($password){
		return crypt($password,$this->salt) ? true : false;
	}



	public static function verify_user($username,$password){
		global $database;
		$user_name = $database->escape_string($username);
		$pass_word = $database->escape_string($password);
		//user whose username and password are entered
		$user_query = "SELECT * FROM ".self::$db_table." WHERE username='{$user_name}' AND password=$pass_word LIMIT 1";
		//get the element
		$user_result_array = self::return_query_result($user_query);

		if(!empty($user_result_array)){
			$fisrt_element = $user_result_array[0];
			return $fisrt_element;
		} else{
			return false;
		}



	}

	public function image_path_and_placeholder(){
		return empty($this->user_image) ? $this->image_placeholder : "./images/" . $this->user_image;
	}

	public function delete_user(){
		if($this->delete()){
			return unlink("./images/".$this->user_image) ? true:false;
		}else{
			return false;
		}
	}


	




};

?>



