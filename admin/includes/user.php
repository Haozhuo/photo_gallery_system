<?php

class User{
	protected static $db_table = "users";
	protected static $db_table_fields = array('username','password','first_name','last_name');
	public $id;
	public $username;
	public $first_name;
	public $last_name;
	public $password;

	//find all the users
	public static function find_all_users(){
		return self::return_query_result("SELECT * FROM ".self::$db_table);
	}
	//find single user with particular id
	public static function find_user_by_id($user_id){

		$user_result_array = self::return_query_result("SELECT * FROM ".self::$db_table." WHERE id={$user_id} LIMIT 1");
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

	private function has_attribute($attribute){
		$properties = get_object_vars($this);
		return array_key_exists($attribute, $properties);
	}
	//get all the useful properties
	protected function properties(){
		//return get_object_vars($this);
		$properties = array();

		foreach(self::$db_table_fields as $db_field){
			if(property_exists($this, $db_field)){
				$properties[$db_field] = $this->$db_field;
			}
		}

		return $properties;
	}
	//escape useful properties before they go into database
	protected function clean_properties(){
		global $database;

		$properties = $this->properties();
		$clean_properties = array();
		foreach($properties as $key=>$value){
			$clean_properties[$key] = $database->escape_string($value);
		}

		return $clean_properties;
	}

	public function save_user(){
		return isset($this->id) ? $this->update_user() : $this->create_user();
	}

	//create user
	public function create_user(){
		global $database;
		//get all the properties of the class
		$properties = $this->clean_properties();
		/*
		$username = $database->escape_string($this->username);
		$password = $database->escape_string($this->password);
		$firstname = $database->escape_string($this->first_name);
		$lastname = $database->escape_string($this->last_name);
		*/
		//use implode to pull out array keys and join them automatically
		/*
		$insert_query = "INSERT INTO ".self::$db_table."(" . implode(",", array_keys($properties)) . ") VALUES ('{$username}','{$password}','{$firstname}','{$lastname}')";
		*/

		$insert_query = "INSERT INTO ".self::$db_table."(" . implode(",", array_keys($properties)) . ") VALUES ('". implode("','", array_values($properties)) ."')";

		$insert_result = $database->query($insert_query);

		if($insert_result){
			$this->id = $database->insert_id();

			return true;
		} else{
			return false;
		}
	}
	//update user
	public function update_user(){
		global $database;
		//like in above, to put all the assingment and queries in an 
		// array
		$properties = $this->clean_properties();
		$properties_pairs = array();

		foreach($properties as $key=>$value){
			$properties_pairs[] = "{$key}='{$value}'";
		}
		
		$id = $this->id;
		/*
		$username = $database->escape_string($this->username);
		$password = $database->escape_string($this->password);
		$firstname = $database->escape_string($this->first_name);
		$lastname = $database->escape_string($this->last_name);
		*/

		$update_query = "UPDATE ".self::$db_table." SET " . implode(",", $properties_pairs) . " WHERE id=$id";

		$database->query($update_query);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;
	}
	//delete user
	public function delete_user(){
		global $database;

		$id = $this->id;
		$delete_query = "DELETE FROM ".self::$db_table." WHERE id=$id LIMIT 1";

		$database->query($delete_query);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;
	}




};

?>



