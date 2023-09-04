<?php

session_start();


$con = mysqli_connect('localhost','Md Tahmid Hasan','tahmid1694');

mysqli_select_db($con, 'yarnology registration');

$name = $_POST['user'];
$pass = $_POST['password'];

$s = "select * from usertable where password = '$pass' && name='$name'";
$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1)
{

header('location:home.php');

}else{

header('location:login.php');

}

 ?>
