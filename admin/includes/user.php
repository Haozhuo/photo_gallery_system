<?php

class User extends Db_object{
	protected static $db_table = "users";
	protected static $db_table_fields = array('username','password','first_name','last_name');
	public $id;
	public $username;
	public $first_name;
	public $last_name;
	public $password;



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


	




};

?>



