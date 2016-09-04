<?php

class User{
	protected static $db_table = "users";
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

	protected function properties(){
		return get_object_vars($this);
	}

	public function save_user(){
		return isset($this->id) ? $this->update_user() : $this->create_user();
	}

	//create user
	public function create_user(){
		global $database;
		$properties = $this->properties();

		$username = $database->escape_string($this->username);
		$password = $database->escape_string($this->password);
		$firstname = $database->escape_string($this->first_name);
		$lastname = $database->escape_string($this->last_name);

		$insert_query = "INSERT INTO ".self::$db_table."(username, password, first_name, last_name) VALUES ('{$username}','{$password}','{$firstname}','{$lastname}')";

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

		$_id = $this->id;
		$username = $database->escape_string($this->username);
		$password = $database->escape_string($this->password);
		$firstname = $database->escape_string($this->first_name);
		$lastname = $database->escape_string($this->last_name);

		$update_query = "UPDATE ".self::$db_table." SET username='{$username}', password='{$password}',first_name='{$firstname}', last_name='{$lastname}' WHERE id=$_id";

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



