<?php

require_once("init_out.php");
include("includes/header.php");


if(empty($_GET['id'])){
    redirect("index.php");
}

$photo = Photo::find_by_id($_GET['id']);

//echo $photo->photo_title;


if(isset($_POST['submit'])){
    echo "HERR!";
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $new_comment = Comment::create_comment($photo->id,$author,$body);

    if($new_comment&&$new_comment->save()){
        redirect("photo.php?id={$photo->id}");
    } else{
        $message = "There is some problems to save comments";
    }
}else{
    $author="";
    $body="";
}

$all_comments = Comment::find_comments($photo->id);

?>




    
        <div class="row">
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php if(isset($photo->photo_title)) echo $photo->photo_title;?></h1>


            

                <!-- Date/Time -->
               
                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/images/<?php echo $photo->photo_filename;?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead">
                    <?php echo $photo->photo_description;?>
                </p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->











                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="body">Comment</label>
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>











                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php
                    foreach($all_comments as $comment){

                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author;?>
                        </h4>
                        <?php
                            echo $comment->body;
                        ?>
                    </div>
                </div>
                <?php
                    }
                ?>

             

            </div>
        </div>

                   
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>

           