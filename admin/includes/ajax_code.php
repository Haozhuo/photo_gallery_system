<?php

require_once("init.php");

$user = new User();

if(isset($_POST['image_name'])){
	$user->ajax_save_image($_POST['image_name'],$_POST['user_id']);

}

if(isset($_POST['photo_id'])){
	Photo::modal_data($_POST['photo_id']);
}

?>