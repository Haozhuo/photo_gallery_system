<?php


function autoload($class){
	$class = strtolower($class);
	$path = "includes/{$class}.php";
	//if that file exists
	if(file_exists($path)){
		require_once($path);
	}else{
		die("File does not exist");
	}
}

spl_autoload_register(autoload);


?>