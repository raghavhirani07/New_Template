<?php include 'header.php'; ?>
<?php include 'config.php'; ?>
<?php
if(array_key_exists('id',$_GET)){
    $postid=$_GET['id'];
    $sql="SELECT * FROM `post`
          INNER JOIN `category` ON `post`.`category` = `category`.`category_id`
          INNER JOIN `user` ON `post`.`author` = `user`.`user_id`
          WHERE `post`.`post_id`={$postid}";
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row=mysqli_fetch_assoc($result)){

?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $row['title']; ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?cid=<?php echo $row['category'];?>'><?php echo $row['category_name']; ?></a>

                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php echo $row['user_id'];?>'><?php echo $row['first_name'].' '.$row['last_name']; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date']; ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
                            <p class="description">
                            <?php echo $row['description']; ?>
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php   }
                        }
                        else{
                            echo '<div class="alert alert-danger" > No Data found </div>';
                        }


}
else
{
    header("location: index.php");
}
?>
<?php include 'footer.php'; ?>
