<?php include "header.php"; ?>
<?php include "config.php";
if($_SESSION['role'] == 0){
       header("location: {$localaddress}/admin/post.php");
    }
    ?>
<?php
if(array_key_exists('save',$_POST)){
    $category_name=$_POST['cat'];
$sql="INSERT INTO `category` ( `category_name`) VALUES ('$category_name');";
$result=mysqli_query($conn,$sql) or die("some problem accure");
if($result) {
    header("Location: {$localaddress}/admin/category.php");
}
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
