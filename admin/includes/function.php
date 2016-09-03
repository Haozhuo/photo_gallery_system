<?php


function autoload_func($class){
	$class = strtolower($class);
	$path = "includes/{$class}.php";
	//if that file exists
	if(file_exists($path)){
		require_once($path);
	}else{
		die("File does not exist");
	}
}

spl_autoload_register(function ($class){
	$class = strtolower($class);
	$path = "includes/{$class}.php";
	//if that file exists
	if(file_exists($path)){
		require_once($path);
	}else{
		die("File does not exist");
	}
});

function redirect($location){
	header("Location: ". $location);
}


?>