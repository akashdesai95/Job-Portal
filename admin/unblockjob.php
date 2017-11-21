<?php

session_start();
        if(!isset($_SESSION['user_username']))
            header('Location: http://localhost/PHPProject/login.php');
        
        
if(!isset($_GET['job_id'])){
	echo "No data!";
	die();
}

$connection=new PDO('mysql:host=localhost;dbname=project','root','');
$statement="SELECT * FROM postjob WHERE job_id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['job_id']))){
	echo "error";
	die();
}

if(!$row=$query->fetch(PDO::FETCH_OBJ)){
	echo "No job found!";
	die();
}

$statement="UPDATE postjob SET closejob=\"open\" WHERE job_id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['job_id']))){
	echo "error";
	die();
}
$statement="UPDATE jobapplications SET closejob=\"open\" where job_id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['job_id']))){
	echo "error";
	die();
}

$location="Location:".$_SERVER['HTTP_REFERER'];
header($location);
die();
?>
