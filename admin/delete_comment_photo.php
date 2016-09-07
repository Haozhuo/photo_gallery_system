<?php
require_once("includes/init.php");


if(!$session->is_signed_in()){
    redirect("login.php");
}
?>

<?php
   if(!isset($_GET['id'])){
        redirect("comments.php");
   }else{
        $comment = Comment::find_by_id($_GET['id']);
        if($comment){
?>

<?php
            $comment->delete();
            redirect("photo_comments.php?id={$comment->photo_id}");

        }
        else
            redirect("photo_comments.php?id={$comment->photo_id}");
   }

?>

?>