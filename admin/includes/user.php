<?php

class User{
	public $id;
	public $username;
	public $first_name;
	public $last_name;
	public $password;

	//find all the users
	public static function find_all_users(){
		return self::return_query_result("SELECT * FROM users");
	}
	//find single user with particular id
	public static function find_user_by_id($user_id){

		$user_result_array = self::return_query_result("SELECT * FROM users WHERE id={$user_id} LIMIT 1");
		//if not empty return first element
		if(!empty($user_result_array)){
			$fisrt_element = $user_result_array[0];
			return $fisrt_element;
		} else{
			return false;
		}
	}

	public static function return_query_result($sql_query){
		global $database;
		$query_result = $database->query($sql_query);

		$object_array = array();

		while($row=mysqli_fetch_assoc($query_result)){
			$object_array[] = self::instantiation($row);
		}
		//return an user array
		return $object_array;
	}

	//instantiation; parameter is returned by find_user_by_id
	public static function instantiation($found_user_record){
        $user = new self;

        foreach($found_user_record as $key=>$value){
        	//if it has attribute
        	if($user->has_attribute($key)){
        		$user->$key = $value;
        	}
        }

        return $user;
	}

	private function has_attribute($attribute){
		$properties = get_object_vars($this);
		return array_key_exists($attribute, $properties);
	}
};

?>