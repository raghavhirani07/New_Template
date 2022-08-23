<?php include 'header.php'; ?>
<?php include 'config.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8"> 
                <!-- post-container -->
                <div class="post-container">
                    <?php
                $limit=3;
                if(!array_key_exists('page',$_GET)){
                    $page=1;
                }
                else{
                $page=$_GET['page'];
                }
                $offset=($page - 1 )* $limit;
                    $sql="SELECT * FROM `post`
                    INNER JOIN `category` ON `post`.`category` = `category`.`category_id`
                    INNER JOIN `user` ON `post`.`author` = `user`.`user_id`
                    ORDER BY `post`.`post_id` DESC LIMIT {$offset},{$limit}";
                    $result=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row=mysqli_fetch_assoc($result)){

                ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" /></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href="single.php?id=<?php echo $row['post_id']; ?>"><?php echo $row['title']; ?></a>
                                    </h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category_id'];?>'><?php echo $row['category_name']; ?></a>
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
                                    <p class="description">
                                    <?php echo  substr($row['description'],0,130). "...." ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>Read more</a>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                        }
                            $sql1="SELECT * FROM `post`";
                            $result1=mysqli_query($conn,$sql1) or die ("Query Failed ");
                                if( mysqli_num_rows($result1)>0)
                                {
                                    $i=1;
                                    echo "<ul class='pagination admin-pagination'>";
                                    $totalrecode=mysqli_num_rows($result1);
                                    $limit=3;
                                    $totalpage=ceil($totalrecode/$limit);
                                    if($page > 1){
                                    echo '<li><a href="post.php?page='.($page - 1).'">Pre</a></li>';
                                    }
                                    for($i;$i <=$totalpage;$i++)
                                    {
                                        if($page == $i){
                                            $active="active";
                                        }
                                        else{
                                            $active="";
                                        }
                                        echo '<li class="'.$active.'"><a href="post.php?page='.$i.' ">'.$i.'</a></li>';
                                    }
                                    if($page < $totalpage){
                                        echo '<li><a href="post.php?page='.($page + 1).'">next</a></li>';
                                        }
                                    echo'</ul>';
                                }
                            }
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<!-- Good file -->
