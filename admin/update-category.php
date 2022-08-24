<?php include "header.php"; ?>
<?php include "config.php";
  if($_SESSION['role'] == 0){
    header("location: {$localaddress}/admin/post.php");
 }
?>
<?php
if(isset($_GET)){
    $id=$_GET['id'];
    $sql="SELECT * FROM `category` WHERE `category_id`='$id'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $category_name=$row['category_name'];
}
    if(array_key_exists('update',$_POST))
    {
        $update_catgory_name= mysqli_real_escape_string( $conn,$_POST['cat_name']);
        $sql="UPDATE `category` SET `category_name` = '$update_catgory_name' WHERE `category_id` = '$id'";
        $result=mysqli_query($conn,$sql);
        if($result)
            {
                header("Location: {$localaddress}/admin/category.php");
            }
    }
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="cat_id" class="form-control" value="<?php echo $_GET['id'] ?>"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat_name" class="form-control" value="<?php echo $category_name; ?>"
                            placeholder="" required>
                    </div>
                    <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>