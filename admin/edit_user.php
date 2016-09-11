<?php include("includes/header.php"); 
      require_once("includes/photo_library_modal.php");
?>
<?php

?>

<?php

if(!isset($_GET['id'])){
    redirect("users.php");
} else{
    $user = User::find_by_id($_GET['id']);
    $id=$_GET['id'];

    if(isset($_POST['update'])){
        if($user){
            global $database;
            $user->username = $_POST['username'];
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];
            //$user->password = $user->crypt_password($_POST['password']);
            $user->password = $_POST['password'];
            
            //if file is uploaded
            if(!empty($_FILES['user_image']['name'])){
                $user->set_image($_FILES['user_image']);
                //upload the file
                move_uploaded_file($user->tmp_path, "./images/".$user->user_image);
                
                $user->update();
            }else{
                //do not have to upload
                $user->update();
            }           
        }

    }
}







?>





        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
          
            <?php include "includes/top_nav.php";?>


            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include "includes/side_nav.php";?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

           <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Users
                            <small>Subheading</small>
                        </h1>

                        <div class="col-md-6 image_box">
                            <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="<?php echo "./images/".$user->user_image;?>"></a>
                        </div>
                        
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="<? echo $user->username;?>">
                            </div>

                            <div class="form-group">
                                <label for="user_image">User Image</label>
                                <input type="file" name="user_image">
                            </div>

                            <div class="form-group">
                                <label for="first_name">Firstname</label>
                                <input type="text" name="first_name" class="form-control" value="<? echo $user->first_name;?>">
                            </div>

                            <div class="form-group">
                                <label for="lat_name">Lastname</label>
                                <input type="text" name="last_name" class="form-control" value="<? echo $user->last_name;?>">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" value="<? echo $user->password;?>">
                            </div>
   

                            <div class="form-group">
                                <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
                            </div>   

                              <div class="form-group">
                                <a id="user_id" class="btn btn-danger" href="delete_user.php?id=<?php echo $id;?>">Delete</a>
                            </div>                        
                                                         
                          
                        </div>
                    </form>



                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>