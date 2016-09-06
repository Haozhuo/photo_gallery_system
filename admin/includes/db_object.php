<?php
//use late static binding
class Db_object {
		//find all the users
	public static function find_all(){
		return static::return_query_result("SELECT * FROM ".static::$db_table);
	}
	//find single user with particular id
	public static function find_by_id($user_id){

		$user_result_array = static::return_query_result("SELECT * FROM ".static::$db_table." WHERE id={$user_id} LIMIT 1");
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
			$object_array[] = static::instantiation($row);
		}
		//return an user array
		return $object_array;
	}

	//instantiation; parameter is returned by find_by_id
	public static function instantiation($found_user_record){
		//get the class name in which instantiation method is called
		//using late static binding
		$calling_calss = get_called_class();
        $user = new $calling_calss;

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


	//get all the useful properties
	protected function properties(){
		//return get_object_vars($this);
		$properties = array();

		foreach(static::$db_table_fields as $db_field){
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

	public function save(){
		return isset($this->id) ? $this->update() : $this->create();
	}

	//create user
	public function create(){
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
		$insert_query = "INSERT INTO ".static::$db_table."(" . implode(",", array_keys($properties)) . ") VALUES ('{$username}','{$password}','{$firstname}','{$lastname}')";
		*/

		$insert_query = "INSERT INTO ".static::$db_table."(" . implode(",", array_keys($properties)) . ") VALUES ('". implode("','", array_values($properties)) ."')";

		$insert_result = $database->query($insert_query);

		if($insert_result){
			$this->id = $database->insert_id();

			return true;
		} else{
			return false;
		}
	}
	//update user
	public function update(){
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

		$update_query = "UPDATE ".static::$db_table." SET " . implode(",", $properties_pairs) . " WHERE id=$id";

		$database->query($update_query);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;
	}
	//delete user
	public function delete(){
		global $database;

		$id = $this->id;
		$delete_query = "DELETE FROM ".static::$db_table." WHERE id=$id LIMIT 1";

		$database->query($delete_query);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;
	}

};


?>