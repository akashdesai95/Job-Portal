
<?php
 session_start();
        if(!isset($_SESSION['user_username']))
            header('Location: http://localhost/PHPProject/login.php');
       

if(!isset($_GET['company_id'])){
	echo "invalid data";
	die();
}

if(!isset($_GET['job_id'])){
	echo "invalid data";
	die();
}

$connection=new PDO('mysql:host=localhost;dbname=project','root','');
$statement="UPDATE postjob SET notification=2,closejob=\"removed\" WHERE job_id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['job_id']))){
	echo "error";
	die();
}
$statement="UPDATE jobapplications SET closejob=\"removed\" WHERE company_id=? AND job_id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['company_id'],$_GET['job_id']))){
	echo "error";
	die();
}

$location="Location:".$_SERVER['HTTP_REFERER'];
header($location);
die();
?>



