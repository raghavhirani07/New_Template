<?php
include "config.php";

   if($_SESSION['role'] == 0){
       header("location: {$localaddress}/admin/post.php");
    }



$userid=$_GET['id'];
$sql="DELETE FROM `user` WHERE `user_id`={$userid}";
if(mysqli_query($conn,$sql)){
    header("Location: {$localaddress}/admin/users.php");
}
else{
    echo "<p class='color:red,margin: 10px 0;'> Can't Delect the user Recode </p>";
}
mysqli_close($conn);
?>