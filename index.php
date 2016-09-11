<?php require_once("includes/header.php"); ?>

<?php

$page = !empty($_GET['page']) ? (int)$_GET['page']:1;

$item_per_page = 20;

$item_total = Photo::count_all();

$paginate = new Paginate($page,$item_per_page,$item_total);
$offset = $paginate->offset();

$query = "SELECT * FROM photos LIMIT {$offset},{$item_per_page}";

 $photos = Photo::return_query_result($query);





?>


        <div class="row">


            <!-- Blog Entries Column -->
            <div class="col-md-12">
            <div class="thumbnails row">
             


            <?php
               
                foreach($photos as $photo){


            ?>
                        
                            <div class="col-xs-6 col-md-3">
                                <a class="thumbnail" href="photo.php?id=<?php echo $photo->id;?>">
                            <img class="home_page_photo" src="admin/images/<?php echo $photo->photo_filename;?>">
                        </a>
                    </div>
                    

            <?php
                }
            ?>

          </div>

 


            </div>

           

            </div>

            
          <div class="row">
               <ul class="pager">
                    <?php

                    if($paginate->page_total()>1){
                        if($paginate->has_next()){
                            $next=$paginate->next();
                            echo "<li class='next'><a href='index.php?page={$next}'>Next</a></li>";
                        }

                    ?>
                        <?php
                            for($i=1;$i<=$paginate->page_total();$i++){
                                if($i==$paginate->current_page){
                                    echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                                }else{
                                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                                }
                            }
                        ?>

                    <?php

                        if($paginate->has_prev()){
                            $prev=$paginate->prev();
                            echo "<li class='previous'><a href='index.php?page={$prev}'>Previous</a></li>";
                        }
                    }



                    ?>
                   
                   
               </ul> 
            </div>





        
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
