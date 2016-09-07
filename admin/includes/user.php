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
	private $salt = '$2a$07$usesomesillystringforsalt$';

	public $tmp_path;

	public $custom_errors_array = array();

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

	//$file is user_image
	public function set_image($file){
		if(empty($file) || !$file || !is_array($file)){
			$this->custom_errors_array[] = "This is no uploaded files there";
			return false;
		} else{
			$this->user_image = $file['name'];
			$this->tmp_path = $file['tmp_name'];

			return true;

		}
	}

	public function save_user(){
		
			//if there is error
			if(!empty($custom_errors_array))
				return false;
			//if any variable is empty
			if(empty($this->user_image) || empty($this->tmp_path)){
				$this->custom_errors_array[] = "The file is not available";
				return false;
			}
			//the whole path to the destination
			$target_path = INCLUDES_PATH . "/" . $this->upload_directory . "/" . $this->user_image;

			if(file_exists($target_path)){
				$this->custom_errors_array[] = "The file alreay existed.";
				return false;
			}
			//upload the file
			if(move_uploaded_file($this->tmp_path, "./images/".$this->user_image)){
				if($this->create()){
					unset($this->tmp_path);
					return true;
				}
			} else{
				$this->custom_errors_array[] = "The file folder does not have permission";
				return false;
			}

			
		
	}


	




};

?>



