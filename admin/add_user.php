<?php include("includes/header.php"); ?>
<?php

/*
$photo = Photo::find_by_id($_GET['id']);

if(isset($_POST['update'])){
    if($photo){
        $photo->photo_title = $_POST['title'];
        $photo->photo_alternate_text = $_POST['alternate_text'];
        $photo->photo_description = $_POST['description'];

        $photo->save();
    }

}

*/

if(isset($_POST['submit'])){
    $user = new User();
    if($user){
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $user->crypt_password($_POST['password']);

        $user->
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
                            Photos
                            <small>Subheading</small>
                        </h1>
                        
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="user_image">Upload Image</label>
                                <input type="file" name="user_image">
                            </div>

                            <div class="form-group">
                                <label for="first_name">Firstname</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="lat_name">Lastname</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary pull-right">
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