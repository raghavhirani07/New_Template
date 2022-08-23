<?php
$hostname="localhost";
$username="root";
$password="";
$database="news-site";
$localaddress="http://localhost/news-site";
$conn=mysqli_connect($hostname,$username,$password,$database);
if(!$conn){
    echo "connection  not succesfull";
}



?>