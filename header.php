<?php
include "config.php";
$page=basename($_SERVER['PHP_SELF']);
switch($page){
        case "single.php":
            if(array_key_exists('id',$_GET)){
               $sql_title="SELECT * FROM `post` WHERE `post_id`={$_GET['id']}";
               $result_title=mysqli_query($conn,$sql_title);
               $row_title=mysqli_fetch_assoc($result_title);
               $page_title=$row_title['title'];
            }
            else
            {
                $page_title="No POST";
            }
            break;
        case "category.php":
            if(array_key_exists('cid',$_GET)){
                $sql_title="SELECT * FROM `category` WHERE `category_id`={$_GET['cid']}";
                $result_title=mysqli_query($conn,$sql_title);
                $row_title=mysqli_fetch_assoc($result_title);
                $page_title=$row_title['category_name'].' News';
             }
             else
             {
                 $page_title="No Post Found";
             }
            break;
        case "author.php":
                if(array_key_exists('aid',$_GET)){
                    $sql_title="SELECT * FROM `user` WHERE `user_id`={$_GET['aid']}";
                    $result_title=mysqli_query($conn,$sql_title);
                    $row_title=mysqli_fetch_assoc($result_title);
                    $page_title='News By '.$row_title['first_name'].' '.$row_title['last_name'];
                }
                else
                {
                    $page_title="No Post Found";
                }
                break;
        case "search.php":
            if(array_key_exists('search',$_GET)){
                $page_title=$_GET['search'];
            }
            else
            {
                $page_title="No Post Found";
            }
                break;
        default:
                    $page_title="News Site ";
                    break;
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title ?></title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    <li><a href="<?php echo $localaddress ?>">HOME </a></li>
                    <?php

                    $sql="SELECT DISTINCT  `category_id`,`category_name` FROM `post`
                    INNER JOIN `category` ON `post`.`category` = `category`.`category_id`";
                    $result=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row=mysqli_fetch_assoc($result)){
                            if(array_key_exists('cid',$_GET)){
                                $cat_id=$_GET['cid'];
                            if($row['category_id'] == $cat_id){
                                $active="active";
                            }
                            else{
                                $active="";
                            }
                        }
                        else
                        {
                            $active="";
                        }
                     ?>
                    <li><a class='<?php echo $active; ?>' href="category.php?cid=<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></a></li>
                    <?php }}
                    else{
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
