 <?php
 require_once('init.php');
 ?>
 <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Subheading</small>
                        </h1>

                        <?php  
                          global $database;




                          
                          $user = new User();
                          $user->username = "example200";
                          $user->first_name = "example200";
                          $user->last_name = "example200";
                          $user->password = "example200";


                          $user->save_user();
                          

                          /*
                          $user=User::find_user_by_id(14);
                          $user->first_name = "10000";

                          $user->save_user();
                          */
                          
                          /*
                          if($user){
                            $user->first_name = "hi";
                            $user->update_user();
                          }
                          */
                          /*
                          $result = mysqli_query($database->connection,"SELECT * FROM users WHERE id=9");
                          while($row=mysqli_fetch_assoc($result)){
                            echo $row['username'] . "<br>";
                            echo $row['first_name'];
                          }*/
                        
                        ?>

                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->