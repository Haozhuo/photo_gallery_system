<?php
require_once("includes/init.php");


if(!$session->is_signed_in()){
    redirect("login.php");
}
?>

<?php
   if(!isset($_GET['id'])){
        redirect("users.php");
   }else{
        $comment = Comment::find_by_id($_GET['id']);
        if($comment){
?>

<?php
            $comment->delete();
            redirect("comments.php");

        }
        else
            redirect("comments.php");
   }

?>

?>