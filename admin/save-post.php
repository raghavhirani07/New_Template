<?php
include "config.php";
if(!isset($_SESSION)){
  session_start();
  }
if(!array_key_exists('username',$_SESSION)){
  header("Location: {$localaddress}/admin/");
  }
if(isset($_FILES['fileToUpload'])){
  $error=array();
  $filename=$_FILES['fileToUpload']['name'];
  $filesize=$_FILES['fileToUpload']['size'];
  $filetmp=$_FILES['fileToUpload']['tmp_name'];
  $filetype=$_FILES['fileToUpload']['type'];
  $fileext=end(explode('.',$filename));
  $extension=array("jpg","png","jpeg");
  if(in_array($fileext,$extension) === false){
    $error[]="This Extension File not Allowed ,please Select vailed ";

  }
  if($filesize > 2097152 ){
    $error[]="File size must be 2mb of lower.";
  }
  if(empty($error)){
    move_uploaded_file($filetmp,"upload/".$filename);
  }
  else{
    print_r($error);
    die();
  }

}

$title=mysqli_real_escape_string($conn,$_POST['post_title']);
$desc=mysqli_real_escape_string($conn,$_POST['postdesc']);
$category_id=mysqli_real_escape_string($conn,$_POST['category']);
$date=date("d M, Y");
$author_id=$_SESSION['id'];

$sql="INSERT INTO `post` ( `title`, `description`, `category`, `post_date`, `author`, `post_img`)
VALUES ( '$title', '$desc', '$category_id', '$date', '$author_id', '$filename')";
// $sql.="UPDATE `category` SET post = post+1 WHERE `category_id `='$category_id'" ;
// $result=mysqli_multi_query($conn,$sql);
  if($result=mysqli_query($conn,$sql)){
    header("location: {$localaddress}/admin/post.php");
  }
  else{
    echo '<div class="alert alert-danger">Query Failed </div>';
  }
?>
