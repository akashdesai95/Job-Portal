<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location:login.php?msg=Session expired, Please login in again");
	die();
}

unset($_SESSION['username']);
session_destroy();
header("Location:login.php?msg=Succesfully logged out");

?>