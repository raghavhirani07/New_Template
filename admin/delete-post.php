<?php
  include "config.php";

if(isset($_GET)){
  $post_id = $_GET['id'];
  $sql1 = "SELECT * FROM post WHERE post_id = {$post_id}";
  $result = mysqli_query($conn, $sql1) or die("Query Failed : Select");
  $row = mysqli_fetch_assoc($result);
  unlink("upload/".$row['post_img']);
  $sql = "DELETE FROM `post` WHERE `post_id` = {$post_id}";
  if(mysqli_query($conn, $sql)){
    header("location: {$localaddress}/admin/post.php");
  }else{
    echo "Query Failed";
  }
}
else
{
  header("location: {$localaddress}/admin/post.php");
}
?>
