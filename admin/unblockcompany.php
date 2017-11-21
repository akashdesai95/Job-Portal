<?php 
session_start();
        if(!isset($_SESSION['user_username']))
            header('Location: http://localhost/PHPProject/login.php');
        
        

if(!isset($_GET['company_id'])){
	echo "No data!";
	die();
}

$connection=new PDO('mysql:host=localhost;dbname=project','root','');
$statement="SELECT * FROM clients WHERE id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['company_id']))){
	echo "error";
	echo $query->errorInfo();
	die();
}

if(!$row=$query->fetch(PDO::FETCH_OBJ)){
	echo "No company found!";
	die();
}

$statement="UPDATE clients SET closejob=\"open\" WHERE id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['company_id']))){
	echo "error";
	die();
}

$statement="UPDATE postjob SET closejob=\"open\" WHERE company_id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['company_id']))){
	echo "error";
	die();
}

$statement="UPDATE jobapplications SET closejob=\"open\" WHERE company_id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['company_id']))){
	echo "error";
	die();
}

$location="Location:".$_SERVER['HTTP_REFERER'];
header($location);
die();
?>



