<!---
<?php
/*
require_once("new_config.php");

class Database{
	//make $connection private
	public $connection;

	function __construct(){
		//connect to database
		$this->open_db_connection();
	}

	public function open_db_connection(){
		//make the connection
		$this->connection=mysqli_connect(DATABASE_HOST,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);

		if(mysqli_connect_errno()){
			die("connection failed " . mysqli_error());
		}

		if(!$this->connection){
			echo "connection error";
		}
	}

	public function query($sql_query){
		$result=mysqli_query($this->connection,$sql_query);

		return $result;
	}

	public function confirm_query($result){
		if(!$result){
			die("Query failed ". mysqli_error());
		} 
	}

	public function escape_string($string){
		$escaped_string=mysqli_real_escape_string($this->connection,$string);
		return $escaped_string;
	}
};

$database = new Database();
*/
?>

-->

<?php

require_once("new_config.php");

class Database{
	//make $connection private
	public $connection;

	function __construct(){
		//connect to database
		$this->open_db_connection();
	}

	public function open_db_connection(){
		//make the connection
		$this->connection=new mysqli(DATABASE_HOST,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);

		if($this->connection->connect_errno){
			die("connection failed " . $this->connection->error);
		}

		if(!$this->connection){
			echo "connection error";
		}
	}

	//query the database
	public function query($sql_query){
		$result=$this->connection->query($sql_query);
		$this->confirm_query($result);
		return $result;
	}

	//confirm result
	public function confirm_query($result){
		if(!$result){
			die("Query failed ". $this->connection->error);
		} 
	}

	//escape string function
	public function escape_string($string){
		$escaped_string=$this->connection->real_escape_string($this->connection,$string);
		return $escaped_string;
	}

	//get the newly inserted id
	public function insert_id(){
		return $this->connection->insert_id;
	}
};

$database = new Database();

?>
















