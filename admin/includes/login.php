<?php require_once("init.php");?>
<?php
	//if signed in 
	if($session->is_signed_in()){
		redirect("index.php");
	}
	//if submitted
	if(isset($_POST['submit'])){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		//Method to check the database user
		$is_user_found = User::verify_user($username,$password);

		//If user is found
		if($is_user_found){
			$session->login();
			redirect('index.php');
		}else{
			$message = "Your message or username is incorrect";
		}


	}



?>


<div class="col-md-4 col-md-offset-3">


	
<form id="login-id" action="" method="post">
	
<div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="username" >

</div>

<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password">
	
</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>


</form>


</div>

