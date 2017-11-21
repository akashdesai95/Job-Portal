<?php
session_start();
        if(!isset($_SESSION['user_username']))
            header('Location: http://localhost/PHPProject/login.php');
        
if(!isset($_GET['id'])){
	echo "Something went wrong";
	die();
}

$connecion=new PDO('mysql:host=localhost;dbname=project','root','');
$statement="SELECT * FROM employees WHERE id=?";
$query=$connecion->prepare($statement);
if(!$query->execute(array($_GET['id']))){
	echo "error";
	die();
}

if(!$row=$query->fetch(PDO::FETCH_OBJ)){
	echo "Employee not available<br>";
	echo "<a href=".$_SERVER['HTTP_REFERER'].">Go Back</a>";
	die();
}

$statement="UPDATE employees SET closejob=? WHERE id=?";
$query=$connecion->prepare($statement);
if(!$query->execute(array("blocked",$_GET['id']))){
	echo "error";
	die();
}

$statement="UPDATE jobapplications SET closejob=? WHERE employee_id=?";
$query=$connecion->prepare($statement);
if(!$query->execute(array("blocked",$_GET['id']))){
	echo "error";
	die();
}
$location="Location:".$_SERVER['HTTP_REFERER'];
header($location);

?>
