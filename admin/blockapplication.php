<?php 
session_start();
 if(!isset($_SESSION['user_username']))
            header('Location: http://localhost/PHPProject/login.php');
        

if(!isset($_GET['employee_id'])){
	echo "No data!";
	die();
}

if(!isset($_GET['job_id'])){
	echo "No data!";
	die();
}

$connection=new PDO('mysql:host=localhost;dbname=project','root','');
$statement="SELECT * FROM jobapplications WHERE employee_id=? and job_id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['employee_id'],$_GET['job_id']))){
	echo "error";
	die();
}

if(!$row=$query->fetch(PDO::FETCH_OBJ)){
	echo "Invalid input";
	die();
}

$statement="UPDATE jobapplications SET closejob=\"blocked\" WHERE employee_id=? and job_id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['employee_id'],$_GET['job_id']))){
	echo "error";
	die();
}


$location="Location:".$_SERVER['HTTP_REFERER'];
header($location);
?>
