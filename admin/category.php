<?php include "config.php"; ?>
<?php include "header.php"; ?>
<?php
   if($_SESSION['role'] == 0){
       header("location: {$localaddress}/admin/post.php");
    }
    ?>
<?php
    if(!array_key_exists('page',$_GET)){
    $page=1;
    }
    else
    {
    $page=$_GET['page'];
    }
    $limit=3;
    $offset=($page - 1)* $limit;
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <?php
                    $sql="SELECT * FROM `category` LIMIT {$offset},{$limit}";
                    $result=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0){
                       echo '<table class="content-table">
                            <thead>
                                <th>S.No.</th>
                                <th>Category Name</th>
                                <th>No. of Posts</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>';
                            while($row=mysqli_fetch_assoc($result)){
                ?>
                                        <tr>
                                            <td class='id'><?php echo $row['category_id'];?></td>
                                            <td><?php echo $row['category_name'];?></td>
                                            <td>
                                                <?php
                                                $category_id=$row['category_id'];
                                                $sql1="SELECT * FROM `post` WHERE `category`=$category_id";
                                                $result1 = mysqli_query($conn,$sql1);
                                                echo mysqli_num_rows($result1);
                                                ?>
                                            </td>
                                            <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id'];?>'><i class='fa fa-edit'></i></a></td>
                                            <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id'];?>'><i class='fa fa-trash-o'></i></a></td>
                                        </tr>
                <?php  }}
                ?>
                    </tbody>
                </table>
                <?php
                $sql1="SELECT * FROM `category`";
                $result1=mysqli_query($conn,$sql1);
                $num =mysqli_num_rows($result1);
                $i=1;
                $limit=3;
                $total_page=ceil($num/$limit);
                if($num > 0)
                {
                    echo"<ul class='pagination admin-pagination'>";
                    if($page > 1){
                        echo '<li><a href=category.php?page='.($page-1).'>Prev.</a></li>';
                    }
                            for($i;$i<=$total_page;$i++){
                                echo '<li><a href=category.php?page='.$i.'>'.$i.'</a></li>';
                            }
                            if($page < $total_page){
                                echo '<li><a href=category.php?page='.($page+1).'>next.</a></li>';
                            }
                           echo ' </ul>';
                        }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
