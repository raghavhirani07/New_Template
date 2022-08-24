<?php include "header.php"; ?>

<?php include "config.php";?>
<?php
   if($_SESSION['role'] == 0){
       header("location: {$localaddress}/admin/post.php");
    }
    ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <?php
                $limit=3;
                if(!array_key_exists('page',$_GET)){
                    $page=1;
                }
                else{
                $page=$_GET['page'];
                }
                $offset=($page - 1 )* $limit;
                $sql= "SELECT * FROM `user` ORDER BY `user_id` DESC LIMIT {$offset},{$limit}";
                $result=mysqli_query($conn,$sql);
                $num=mysqli_num_rows($result);
                if($num > 0)
                {
                ?>

                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        while($row=mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td class='id'><?php echo $row['user_id'] ?></td>
                            <td><?php echo $row['first_name']." ".$row['last_name'] ?></td>
                            <td><?php echo $row['username'] ?></td>
                            <td><?php echo ($row['role'] == 0)? "Normal" :  "Admin"; ?></td>
                            <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id'];?>'><i
                                        class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-user.php?id=<?php echo $row['user_id'];?>'><i
                                        class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            <?php }

                $sql1="SELECT * FROM `user`";
                $result1=mysqli_query($conn,$sql1) or die ("Query Failed ");
                    if( mysqli_num_rows($result1)>0)
                    {
                        $i=1;
                        echo "<ul class='pagination admin-pagination'>";
                        $totalrecode=mysqli_num_rows($result1);
                        $limit=3;
                        $totalpage=ceil($totalrecode/$limit);
                        if($page > 1){
                        echo '<li><a href="users.php?page='.($page - 1).'">Pre</a></li>';
                        }
                        for($i;$i <=$totalpage;$i++)
                        {
                            if($page == $i){
                                $active="active";
                            }
                            else{
                                $active="";
                            }
                            echo '<li class="'.$active.'"><a href="users.php?page='.$i.' ">'.$i.'</a></li>';
                        }
                        if($page < $totalpage){
                            echo '<li><a href="users.php?page='.($page + 1).'">next</a></li>';
                            }
                        echo'</ul>';
                    }
            ?>
            </div>
        </div>
    </div>
</div>
<?php include "header.php"; ?>