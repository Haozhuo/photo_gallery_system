<?php include("includes/header.php"); ?>
<?php
if(!$session->is_signed_in()){
    redirect("login.php");
}
?>

<?php
   if(!isset($_GET['id'])){
        redirect("users.php");
   }else{
        $user = User::find_by_id($_GET['id']);
        if($user){
?>

<?php
            $user->delete_user();
            redirect("users.php");

        }
        else
            redirect("users.php");
   }

?>

  <?php include("includes/footer.php"); ?>