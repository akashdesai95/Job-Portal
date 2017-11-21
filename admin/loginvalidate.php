<?php
if($_POST['username'] == null || $_POST['password'] ==null){
	header("Location:login.php?msg=Please enter all fields!");
	die();
}


if($_POST['username']=="admin" && $_POST['password']=="admin"){
	session_start();
	$_SESSION['username']="admin";
	header("location:home.php");
	die();
}else{
	header("Location:login.php?msg=Invalid username or password");
	die();
}


?>