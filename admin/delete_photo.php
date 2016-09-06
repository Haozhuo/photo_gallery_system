<?php include("includes/header.php"); ?>
<?php
if(!$session->is_signed_in()){
    redirect("login.php");
}
?>

<?php
   if(!isset($_GET['id'])){
        redirect("photos.php");
   }else{
        $photo = Photo::find_by_id($_GET['id']);
        if($photo){
?>

    <script src="./js/app.js"></script>
<?php
            $photo->delete_photo();

        }
        else
            redirect("photos.php");
   }

?>

  <?php include("includes/footer.php"); ?>